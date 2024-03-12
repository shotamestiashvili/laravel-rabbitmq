<?php

namespace LaravelRabbitmq\Services;

use LaravelRabbitmq\Interfaces\ConnectionInterface;
use Illuminate\Support\Facades\App;
use PhpAmqpLib\Wire\AMQPTable;

class Queue
{
    private Connection $connection;

    public function __construct()
    {
        $this->connection = App::get(ConnectionInterface::class);
    }

    public function queueDeclare(array $config): array|null
    {
        return $this->connection->getChannel()->queue_declare(
            queue: $config['queue'],
            passive: $config['passive'],
            durable: $config['durable'],
            exclusive: $config['exclusive'],
            auto_delete: $config['auto_delete'],
            nowait:$config['nowait'],
            arguments:  new AMQPTable($config['arguments']),
            ticket: $config['ticket'],
        );
    }

    public function queueBind(array $config): array|null
    {
        return $this->connection->getChannel()->queue_bind(...$config);
    }
}
