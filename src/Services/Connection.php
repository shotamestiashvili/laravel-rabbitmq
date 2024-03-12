<?php

namespace LaravelRabbitmq\Services;

use LaravelRabbitmq\Interfaces\ConnectionInterface;
use PhpAmqpLib\Channel\AbstractChannel;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Connection implements ConnectionInterface
{
    private AMQPStreamConnection $connection;
    private AbstractChannel|AMQPChannel $channel;

    /**
     * @throws \Exception
     */
    public function __construct(array $config)
    {
        $this->connection = new AMQPStreamConnection(
            $config['host'],
            $config['port'],
            $config['user'],
            $config['password']);


        $this->channel = $this->connection->channel();

        $this->channel->basic_qos(0, 10000, null);
    }

    public function getChannel(): AbstractChannel|AMQPChannel
    {
        return $this->channel;
    }

    public function getConnection(): AMQPStreamConnection
    {
        return $this->connection;
    }

    public function closeChannel(): mixed
    {
        return $this->connection->channel()->close();
    }

    /**
     * @throws \Exception
     */
    public function closeConnection(): mixed
    {
        return $this->connection->close();
    }
}
