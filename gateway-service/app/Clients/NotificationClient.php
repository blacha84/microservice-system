<?php

namespace App\Clients;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotificationClient
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.notification_service.url');
    }

    public function sendPasswordReset(string $email, string $resetLink): void
    {
        try {

            Http::baseUrl($this->baseUrl)
                ->timeout(5)
                ->post('/send-password-reset', [
                    'email' => $email,
                    'reset_link' => $resetLink
                ])
                ->throw();

        } catch (\Throwable $e) {

            Log::error('Notification service error', [
                'email' => $email,
                'error' => $e->getMessage()
            ]);

        }
    }
}
