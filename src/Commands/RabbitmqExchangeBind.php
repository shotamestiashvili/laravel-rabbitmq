<?php

namespace LaravelRabbitmq\Commands;

use LaravelRabbitmq\Interfaces\WorkerInterface;
use Illuminate\Console\Command;

class RabbitmqExchangeBind extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:exchange:bind';

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
        $worker->exchangeBind();
    }
}
