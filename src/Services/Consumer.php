<?php

namespace LaravelRabbitmq\Services;

use LaravelRabbitmq\Interfaces\ConnectionInterface;
use Illuminate\Support\Facades\App;

class Consumer
{
    private Connection $connection;

    public function __construct()
    {
        $this->connection = App::get(ConnectionInterface::class);
    }

    public function consume(string|null $queue, array $config, callable $handler): void
    {
        while (true) {

            $actualQueue = $queue ?? $config['queue'];

            $process_message = function ($message) use ($actualQueue, $handler) {
                $handler($message, $actualQueue);
            };

            $this->connection->getChannel()->basic_consume(
                $actualQueue,
                $config['consumer_tag'],
                $config['no_local'],
                $config['no_ack'],
                $config['exclusive'],
                $config['nowait'],
                $process_message
            );

            $shutdown = function ($channel, $connection) {
                $channel->close();
                $connection->close();
            };


            register_shutdown_function(
                $shutdown,
                $this->connection->getChannel(),
                $this->connection->getConnection()
            );

            try {
                $this->connection->getChannel()->consume();
            } catch (\Throwable $exception) {
                echo $exception->getMessage();
            }
        }
    }
}
