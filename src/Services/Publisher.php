<?php

namespace LaravelRabbitmq\Services;

use LaravelRabbitmq\Interfaces\ConnectionInterface;
use Illuminate\Support\Facades\App;
use PhpAmqpLib\Message\AMQPMessage;

class Publisher
{
    private Connection $connection;
    private Message $message;

    public function __construct()
    {
        $this->connection = App::get(ConnectionInterface::class);
        $this->message = app(Message::class);
    }

    /**
     * @throws \Exception
     */
    public function basicPublish(string $payload, array $config): void
    {
        if (!$config['queue'] && !$config['exchange']) {
            throw new \Exception("Please define Exchange or Queue where you want to publish the message");
        }

        $destination = $config['exchange'] ?? $config['queue'];

        $routing_key = $config['routing_key'];

        if (!$routing_key) {
            $routing_key = $config['queue'];
        }

        $message = $this->message->setMessage($payload, [
                'content_type' => 'application/json',
                'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
            ])
            ->setHeader(['content-type' => 'application/json'])
            ->getBody();

        $this->connection
            ->getChannel()
            ->basic_publish(
                $message,
                $destination,
                $routing_key,
                $config['mandatory'],
                $config['immediate'],
                $config['ticket']
            );
    }

    public function publishBatch(array $payloads, array $config): void
    {
        if (!$config['queue'] && !$config['exchange']) {
            throw new \Exception("Please define the Exchange or Queue");
        }

        $destination = $config['exchange'] ?? $config['queue'];

        foreach ($payloads as $payload) {

            $message = $this->message->setMessage($payload)->getBody();

            $routing_key = $config['routing_key'];

            if (!$routing_key) {
                $routing_key = $config['queue'];
            }

            $this->connection
                ->getChannel()
                ->batch_basic_publish(
                    $message,
                    $destination,
                    $routing_key,
                    $config['mandatory'],
                    $config['immediate'],
                    $config['ticket']
                );
        }
        $this->connection->getChannel()->publish_batch();
    }
}
