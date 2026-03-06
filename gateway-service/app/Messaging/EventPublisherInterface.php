<?php

namespace App\Messaging;

interface EventPublisherInterface
{
    /**
     * @param object $event
     * @return void
     */
    public function publish(object $event): void;
}
