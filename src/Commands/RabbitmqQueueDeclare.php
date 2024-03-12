<?php

namespace LaravelRabbitmq\Commands;

use LaravelRabbitmq\Interfaces\WorkerInterface;
use Illuminate\Console\Command;

class RabbitmqQueueDeclare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:queue:declare';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(WorkerInterface $worker)
    {
        $worker->queueDeclare();
    }
}
