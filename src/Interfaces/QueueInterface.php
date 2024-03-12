<?php

namespace LaravelRabbitmq\Interfaces;

interface QueueInterface
{
    public function queueDeclare(): array|null;
    public function queueBind(): array|null;
}
