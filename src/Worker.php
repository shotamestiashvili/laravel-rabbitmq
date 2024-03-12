<?php

namespace LaravelRabbitmq;

use LaravelRabbitmq\Interfaces\ConnectionInterface;
use LaravelRabbitmq\Interfaces\WorkerInterface;
use LaravelRabbitmq\Services\Consumer;
use LaravelRabbitmq\Services\Exchange;
use LaravelRabbitmq\Services\Publisher;
use LaravelRabbitmq\Services\Queue;

class Worker implements WorkerInterface
{
    private Publisher $publisher;
    private Consumer $consumer;
    private Queue $queue;
    private Exchange $exchange;

    public function __construct(
        public ConnectionInterface $connection,
        public array $config,
    ){
        $this->publisher = app(Publisher::class);
        $this->consumer = app(Consumer::class);
        $this->queue = app(Queue::class);
        $this->exchange = app(Exchange::class);
    }

    /**
     * @throws \Exception
     */
    public function basicPublish(string $payload): void
    {
        $this->publisher->basicPublish(
            payload: $payload,
            config: $this->config['publish']
        );
    }

    /**
     * @throws \Exception
     */
    public function publishBatch(array $payloads): void
    {

        $this->publisher->publishBatch(
            payloads: $payloads,
            config: $this->config['publish'],
        );
    }

    public function consume(string|null $queue, callable $handler): void
    {
        $this->consumer->consume(
            queue: $queue,
            config: $this->config['consume'],
            handler: $handler,
        );
    }

    public function queueDeclare(): void
    {
        $this->queue->queueDeclare(
            config: $this->config['queue']['options']['declare']
        );
    }

    public function queueBind(): void
    {
        $this->queue->queueBind(
            config: $this->config['queue']['options']['bind']
        );
    }

    public function exchangeDeclare(): array|null
    {
        return $this->exchange->exchangeDeclare(
            config: $this->config['exchange']['options']['declare']
        );
    }

    public function exchangeBind(): array|null
    {
        return $this->exchange->exchangeBind(
            config: $this->config['exchange']['options']['bind']
        );
    }
}
