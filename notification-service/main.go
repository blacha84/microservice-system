package main

import (
	"fmt"
	"log"
	"net/http"

	"notification-service/internal/api"
	"notification-service/internal/consumer"
	"notification-service/internal/mailer"
)

func main() {

	fmt.Println("Starting notification service...")

	m := mailer.NewMailer()

	// start RabbitMQ consumer
	go consumer.StartUserRegisteredConsumer(m)

	// HTTP endpoint for password reset
	http.HandleFunc(
		"/send-password-reset",
		api.PasswordResetHandler(m),
	)

	fmt.Println("HTTP API listening on 0.0.0.0:8081")

	err := http.ListenAndServe("0.0.0.0:8081", nil)
	if err != nil {
		log.Fatal(err)
	}
}