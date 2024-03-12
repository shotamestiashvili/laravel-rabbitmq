<?php

return [
    'connection' => [
        'host' => env('RABBITMQ_HOST', '127.0.0.1'),
        'port' => env('RABBITMQ_PORT', '5672'),
        'user' => env('RABBITMQ_USER', 'guest'),
        'password' => env('RABBITMQ_PASSWORD', 'guest'),
    ],

    'publish' => [
        [
            'exchange' => 'q.cai1',
            'queue' => '',
            'routing_key' => '',
            'mandatory' => false,
            'immediate' => false,
            'ticket' => null
        ],
    ],

    'consume' => [
        'queue' => 'q.cai3',
        'consumer_tag' => '',
        'no_local' => false,
        'no_ack' => false,
        'exclusive' => false,
        'nowait' => false,
        'callback' => null,
        'ticket' => null,
        'arguments' => []
    ],


    'queue' => [
        'options' => [
            'declare' => [
                'queue' => 't_test1',
                'passive' => false,
                'durable' => true,
                'exclusive' => false,
                'auto_delete' => false,
                'nowait' => false,
                'arguments' => [
                    'x-dead-letter-exchange' => 't_test1',
                    'x-message-ttl' => 15000,
                    'x-expires' => 16000
                ],
                'ticket' => null
            ],

            'bind' => [
                'queue' => 'my.first.q',
                'exchange' => 'my.first.ex',
                'routing_key' => '',
                'nowait' => false,
                'arguments' => [],
                'ticket' => null
            ]
        ],
    ],

    'exchange' => [
        'options' => [
            'declare' => [
                'exchange' => 'my.first.ex2',
                'type' => 'fanout',
                'passive' => false,
                'durable' => true,
                'auto_delete' => false,
                'internal' => false,
                'nowait' => false,
                'arguments' => [],
                'ticket' => null,
            ],

            'bind' => [
                'destination' => 'my.first.ex',
                'source' => 'q.cai',
                'routing_key' => '',
                'nowait' => false,
                'arguments' => [],
                'ticket' => null
            ]
        ],
    ],

    'message' => [
        'body' => 'Hello, RabbitMQ!', // The actual message content
        'properties' => [
            'delivery_mode' => 2, // 1 or 2 (1 for non-persistent, 2 for persistent)
            'content_type' => 'text/plain',
            'content_encoding' => 'gzip', // Example content encoding
            'application_headers' => [
                'key1' => 'value1',
                'key2' => 'value2',
            ],
            'priority' => 5, // Example priority level
            'correlation_id' => 'abc123', // Example correlation ID
            'reply_to' => 'reply_queue', // Example reply-to queue
            'expiration' => '60000', // Example message expiration time in milliseconds
            'message_id' => 'msg_123', // Example message ID
            'timestamp' => time(), // Example timestamp
            'type' => 'custom_type', // Example message type
            'user_id' => 'user123', // Example user ID
            'app_id' => 'my_app', // Example application ID
            'cluster_id' => 'cluster_1', // Example cluster ID
        ],
    ]
];
