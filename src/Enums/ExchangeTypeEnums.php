<?php

namespace LaravelRabbitmq\Enums;

use PhpAmqpLib\Exchange\AMQPExchangeType;

enum ExchangeTypeEnums: string
{
    case FANOUT = 'fanout';
    case DIRECT = 'direct';
    case HEADERS = 'headers';
    case TOPIC = 'topic';

    public function toAMQPExchangeType(): string
    {
        return match ($this) {
            self::FANOUT => AMQPExchangeType::FANOUT,
            self::DIRECT => AMQPExchangeType::DIRECT,
            self::HEADERS => AMQPExchangeType::HEADERS,
            self::TOPIC => AMQPExchangeType::TOPIC,
        };
    }
}
