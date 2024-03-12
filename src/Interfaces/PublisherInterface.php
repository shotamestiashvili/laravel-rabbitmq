<?php

namespace LaravelRabbitmq\Interfaces;

use LaravelRabbitmq\Services\Connection;
use LaravelRabbitmq\Services\Message;
use PhpAmqpLib\Message\AMQPMessage;

interface PublisherInterface
{
    public function basicPublish(AMQPMessage $message, Connection $connection, array $config,): void;
    public function publishBatch(array $messages, Connection $connection,  array $config): void;
}
