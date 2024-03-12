<?php

namespace LaravelRabbitmq\Interfaces;

use PhpAmqpLib\Channel\AbstractChannel;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

interface ConnectionInterface
{
    public function getChannel(): AbstractChannel|AMQPChannel;
    public function getConnection(): AMQPStreamConnection;
    public function closeChannel(): mixed;
    public function closeConnection(): mixed;

}
