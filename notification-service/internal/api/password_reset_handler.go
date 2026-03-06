package api

import (
	"encoding/json"
	"log"
	"net/http"

	"notification-service/internal/mailer"
	"notification-service/internal/templates"
)

type PasswordResetRequest struct {
	Email     string `json:"email"`
	ResetLink string `json:"reset_link"`
}

func PasswordResetHandler(m *mailer.Mailer) http.HandlerFunc {

	return func(w http.ResponseWriter, r *http.Request) {

		var req PasswordResetRequest

		err := json.NewDecoder(r.Body).Decode(&req)
		if err != nil {

			http.Error(w, "Invalid JSON", http.StatusBadRequest)
			return
		}

		body, err := templates.Render(
			"templates/password_reset_email.html",
			req,
		)

		if err != nil {

			log.Println("Template error:", err)

			http.Error(w, "Template error", 500)
			return
		}

		err = m.Send(
			req.Email,
			"Reset your password",
			body,
		)

		if err != nil {

			log.Println("Email error:", err)

			http.Error(w, "Email failed", 500)
			return
		}

		w.WriteHeader(http.StatusOK)
	}
}