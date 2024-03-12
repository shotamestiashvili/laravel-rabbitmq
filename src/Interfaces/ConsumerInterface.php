<?php

namespace LaravelRabbitmq\Interfaces;

use LaravelRabbitmq\Services\Connection;

interface ConsumerInterface
{
    public function consume(Connection $connection, array $config);
}
