package main

import (
	"bytes"
	"encoding/json"
	"fmt"
	"log"
	"net/smtp"
	"text/template"

	amqp "github.com/rabbitmq/amqp091-go"
)

type UserRegisteredEvent struct {
	UserID        int    `json:"user_id"`
	Email         string `json:"email"`
	Name          string `json:"name"`
	ActivationURL string `json:"activation_url"`
}

func renderHTMLTemplate(event UserRegisteredEvent) (string, error) {

	tmpl, err := template.ParseFiles("templates/activation_email.html")
	if err != nil {
		return "", err
	}

	var buf bytes.Buffer

	err = tmpl.Execute(&buf, event)
	if err != nil {
		return "", err
	}

	return buf.String(), nil
}

func sendEmail(event UserRegisteredEvent) error {

	from := "no-reply@parking-system.local"
	smtpHost := "localhost"
	smtpPort := "1025"

	subject := "Activate your Parking System account"

	body, err := renderHTMLTemplate(event)
	if err != nil {
		return err
	}

	message := []byte(
		"From: " + from + "\r\n" +
			"To: " + event.Email + "\r\n" +
			"Subject: " + subject + "\r\n" +
			"MIME-Version: 1.0\r\n" +
			"Content-Type: text/html; charset=UTF-8\r\n\r\n" +
			body,
	)

	return smtp.SendMail(
		smtpHost+":"+smtpPort,
		nil,
		from,
		[]string{event.Email},
		message,
	)
}

func main() {

	fmt.Println("Starting notification service...")

	conn, err := amqp.Dial("amqp://rabbitmq:rabbitmq@localhost:5672/")
	if err != nil {
		log.Fatal("RabbitMQ connection error:", err)
	}
	defer conn.Close()

	ch, err := conn.Channel()
	if err != nil {
		log.Fatal("Channel error:", err)
	}
	defer ch.Close()

	err = ch.Qos(
		1,
		0,
		false,
	)
	if err != nil {
		log.Fatal("QoS error:", err)
	}

	_, err = ch.QueueDeclare(
		"user.registered",
		true,
		false,
		false,
		false,
		nil,
	)
	if err != nil {
		log.Fatal("Queue declare error:", err)
	}

	msgs, err := ch.Consume(
		"user.registered",
		"",
		false,
		false,
		false,
		false,
		nil,
	)
	if err != nil {
		log.Fatal("Consume error:", err)
	}

	fmt.Println("Waiting for user.registered events...")

	for msg := range msgs {

		var event UserRegisteredEvent

		err := json.Unmarshal(msg.Body, &event)
		if err != nil {

			log.Println("JSON error:", err)

			msg.Nack(false, false)
			continue
		}

		fmt.Println("----- NEW USER -----")
		fmt.Println("Email:", event.Email)

		err = sendEmail(event)
		if err != nil {

			log.Println("Email error:", err)

			msg.Nack(false, true)
			continue
		}

		fmt.Println("Email sent")

		msg.Ack(false)
	}
}