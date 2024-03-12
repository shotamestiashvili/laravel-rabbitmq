<?php

namespace LaravelRabbitmq\Commands;

use LaravelRabbitmq\Interfaces\WorkerInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitmqConsume extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:consume {queue?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(WorkerInterface $worker): void
    {
        $queue = $this->argument('queue') ?? null;

        $handler = function (AMQPMessage $message, $queue) {
            Log::info($message->getBody() . ' from queue:  ' . $queue);
            var_dump($message->getConsumerTag());
            $message->ack();
        };

        $worker->consume($queue, $handler);
    }
}
