package mailer

import "net/smtp"

type Mailer struct {
	From     string
	SMTPHost string
	SMTPPort string
}

func NewMailer() *Mailer {
	return &Mailer{
		From:     "no-reply@parking-system.local",
		SMTPHost: "mailpit",
		SMTPPort: "1025",
	}
}

func (m *Mailer) Send(to string, subject string, body string) error {

	message := []byte(
		"From: " + m.From + "\r\n" +
			"To: " + to + "\r\n" +
			"Subject: " + subject + "\r\n" +
			"MIME-Version: 1.0\r\n" +
			"Content-Type: text/html; charset=UTF-8\r\n\r\n" +
			body,
	)

	return smtp.SendMail(
		m.SMTPHost+":"+m.SMTPPort,
		nil,
		m.From,
		[]string{to},
		message,
	)
}