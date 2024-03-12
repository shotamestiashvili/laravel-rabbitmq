<?php

namespace LaravelRabbitmq\Enums;

use PhpAmqpLib\Message\AMQPMessage;

enum MessageDeliveryEnums: string
{
    case PERSISTENT = 'persistent';
    case NON_PERSISTENT = 'non_persistent';
    public function deliveryMode(): string
    {
        return match ($this) {
            self::PERSISTENT => AMQPMessage::DELIVERY_MODE_PERSISTENT,
            self::NON_PERSISTENT => AMQPMessage::DELIVERY_MODE_NON_PERSISTENT,
        };
    }
}
