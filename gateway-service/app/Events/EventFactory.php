<?php

namespace App\Events;

class EventFactory
{
    /**
     * @param int $id
     * @param string $email
     * @param string $name
     * @param string $activationUrl
     * @return UserRegisteredEvent
     */
    public function createUserRegistered(
        int $id,
        string $email,
        string $name,
        string $activationUrl
    ): UserRegisteredEvent {

        return new UserRegisteredEvent(
            $id,
            $email,
            $name,
            $activationUrl
        );
    }
}
