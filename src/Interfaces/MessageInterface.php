<?php

namespace LaravelRabbitmq\Interfaces;

use PhpAmqpLib\Message\AMQPMessage;

interface MessageInterface
{
    public function getBody(): AMQPMessage;
    public function setMessage(mixed $message): self;
}
