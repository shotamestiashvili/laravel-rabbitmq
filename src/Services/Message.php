<?php

namespace LaravelRabbitmq\Services;

use LaravelRabbitmq\Enums\MessagePropertyEnums;
use LaravelRabbitmq\Interfaces\MessageInterface;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class Message implements MessageInterface
{
    public AMQPMessage $body;
    public AMQPTable $headers;
    public function __construct()
    {
    }

    public function setMessage(mixed $message, array $properties = []): self
    {
//        $this->body = new AMQPMessage($message, $properties);
//
//        return $this;
        $validProperties = [];

        foreach ($properties as $key => $value) {
            $validProperties [MessagePropertyEnums::tryFrom($key)] = $value;
        }

        $this->body = new AMQPMessage($message, $validProperties);

        return $this;
    }

    public function setHeader(array $header = [])
    {
        $this->headers = new AMQPTable($header);
        $this->body->set('application_headers', $this->headers);

        return $this;
    }

    public function getBody(): AMQPMessage
    {
        return $this->body;
    }
}
