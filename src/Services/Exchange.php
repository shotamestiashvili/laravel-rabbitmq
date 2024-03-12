<?php

namespace LaravelRabbitmq\Services;

use LaravelRabbitmq\Enums\ExchangeTypeEnums;
use LaravelRabbitmq\Interfaces\ConnectionInterface;
use Illuminate\Support\Facades\App;
use PhpAmqpLib\Wire\AMQPTable;

class Exchange
{
    private Connection $connection;

    public function __construct()
    {
        $this->connection = App::get(ConnectionInterface::class);
    }
    public function exchangeDeclare(array $config): array|null
    {
        return $this->connection->getChannel()->exchange_declare(
            exchange: $config['exchange'],
            type: ExchangeTypeEnums::from($config['type'])->toAMQPExchangeType(),
            passive: $config['passive'],
            durable: $config['durable'],
            auto_delete: $config['auto_delete'],
            internal: $config['internal'],
            nowait: $config['nowait'],
            arguments: new AMQPTable($config['arguments']),
            ticket: $config['ticket'],
        );
    }

    public function exchangeBind(array $config): array|null
    {
        return $this->connection->getChannel()->exchange_bind(...$config);
    }
}
