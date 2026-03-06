package consumer

import (
	"encoding/json"
	"fmt"
	"log"

	amqp "github.com/rabbitmq/amqp091-go"

	"notification-service/internal/mailer"
	"notification-service/internal/templates"
)

type UserRegisteredEvent struct {
	UserID        int    `json:"user_id"`
	Email         string `json:"email"`
	Name          string `json:"name"`
	ActivationURL string `json:"activation_url"`
}

func StartUserRegisteredConsumer(m *mailer.Mailer) {

	conn, err := amqp.Dial("amqp://rabbitmq:rabbitmq@rabbitmq:5672/")
	if err != nil {
		log.Fatal("RabbitMQ connection error:", err)
	}

	ch, err := conn.Channel()
	if err != nil {
		log.Fatal("Channel error:", err)
	}

	err = ch.Qos(1, 0, false)
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

		body, err := templates.Render(
			"templates/activation_email.html",
			event,
		)
		if err != nil {

			log.Println("Template error:", err)

			msg.Nack(false, false)
			continue
		}

		err = m.Send(
			event.Email,
			"Activate your Parking System account",
			body,
		)
		if err != nil {

			log.Println("Email error:", err)

			msg.Nack(false, true)
			continue
		}

		fmt.Println("Activation email sent:", event.Email)

		msg.Ack(false)
	}
}