<?php

namespace LaravelRabbitmq\Interfaces;

interface WorkerInterface
{
    public function basicPublish(string $payload): void;
    public function publishBatch(array $payloads): void;
    public function consume(string|null $queue, callable $handler);
    public function queueDeclare(): void;
    public function queueBind(): void;
    public function exchangeDeclare(): array|null;
    public function exchangeBind(): array|null;
}
