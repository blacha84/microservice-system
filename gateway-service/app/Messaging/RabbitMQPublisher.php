<?php

namespace App\Messaging;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQPublisher implements EventPublisherInterface
{
    /**
     * @param AMQPStreamConnection $connection
     */
    public function __construct(
        private AMQPStreamConnection $connection
    ) {}

    /**
     * @param object $event
     * @return void
     */
    public function publish(object $event): void
    {
        $channel = $this->connection->channel();

        $channel->queue_declare(
            'user.registered',
            false,
            true,
            false,
            false
        );

        $message = new AMQPMessage(
            json_encode($event->toArray()),
            ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]
        );

        $channel->basic_publish(
            $message,
            '',
            $event->routingKey()
        );

        $channel->close();
    }
}
