<?php

namespace LaravelRabbitmq;

use LaravelRabbitmq\Commands\RabbitmqConsume;
use LaravelRabbitmq\Commands\RabbitmqExchangeBind;
use LaravelRabbitmq\Commands\RabbitmqExchangeDeclare;
use LaravelRabbitmq\Commands\RabbitmqQueueBind;
use LaravelRabbitmq\Commands\RabbitmqQueueDeclare;
use LaravelRabbitmq\Interfaces\ConnectionInterface;
use LaravelRabbitmq\Interfaces\MessageInterface;
use LaravelRabbitmq\Interfaces\WorkerInterface;
use LaravelRabbitmq\Services\Connection;
use LaravelRabbitmq\Services\Message;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelRabbitmqServiceProvider extends PackageServiceProvider
{

    public function register(): void
    {
        $this->app->bind(ConnectionInterface::class, function () {
            return new Connection(config('rabbitmq.connection'));
        });

        $this->app->bind(WorkerInterface::class, function () {
            return new Worker(
                App::make(ConnectionInterface::class),
                config('rabbitmq')
            );
        });

        $this->app->bind(MessageInterface::class, function () {
            return new Message();
        });
    }
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-rabbitmq')
            ->hasConfigFile()
            ->hasCommands([
                RabbitmqConsume::class,
                RabbitmqExchangeBind::class,
                RabbitmqExchangeDeclare::class,
                RabbitmqQueueBind::class,
                RabbitmqQueueDeclare::class,
            ]);
    }
}
