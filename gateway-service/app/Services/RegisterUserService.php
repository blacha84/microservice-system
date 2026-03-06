<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Events\EventFactory;
use App\Messaging\EventPublisherInterface;

class RegisterUserService
{
    /**
     * @param EventPublisherInterface $publisher
     * @param EventFactory $eventFactory
     */
    public function __construct(
        private EventPublisherInterface $publisher,
        private EventFactory $eventFactory
    ) {}

    /**
     * @param array $data
     * @return User
     */
    public function register(array $data): User
    {
        $activationToken = Str::uuid()->toString();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_active' => false,
            'activation_token' => $activationToken
        ]);

        $activationUrl =
            config('app.url') .
            '/activate?token=' .
            $activationToken;

        $event = $this->eventFactory->createUserRegistered(
            $user->id,
            $user->email,
            $user->name,
            $activationUrl
        );

        $this->publisher->publish($event);

        return $user;
    }
}
