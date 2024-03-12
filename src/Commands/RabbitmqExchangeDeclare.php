<?php

namespace LaravelRabbitmq\Commands;

use LaravelRabbitmq\Interfaces\WorkerInterface;
use Illuminate\Console\Command;

class RabbitmqExchangeDeclare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:exchange:declare';

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
        $worker->exchangeDeclare();
    }
}
