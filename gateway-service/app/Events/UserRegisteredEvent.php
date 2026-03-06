<?php

namespace App\Events;

class UserRegisteredEvent
{
    /**
     * @param int $userId
     * @param string $email
     * @param string $name
     * @param string $activationUrl
     */
    public function __construct(
        public int $userId,
        public string $email,
        public string $name,
        public string $activationUrl
    ) {}

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'email' => $this->email,
            'name' => $this->name,
            'activation_url' => $this->activationUrl,
        ];
    }

    /**
     * @return string
     */
    public function routingKey(): string
    {
        return 'user.registered';
    }
}
