<?php

namespace LaravelRabbitmq\Interfaces;

interface ExchangeInterface
{
    public function exchangeDeclare(): array|null;
    public function exchangeBind(): array|null;
}
