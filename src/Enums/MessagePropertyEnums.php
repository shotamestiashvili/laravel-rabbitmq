<?php

namespace LaravelRabbitmq\Enums;
enum MessagePropertyEnums: string
{
    case content_type = 'content_type';
    case content_encoding = 'content_encoding';
    case application_headers = 'application_headers';
    case delivery_mode = 'delivery_mode';
    case priority = 'priority';
    case correlation_id = 'correlation_id';
    case reply_to = 'reply_to';
    case expiration = 'expiration';
    case message_id = 'message_id';
    case timestamp = 'timestamp';
    case type = 'type';
    case user_id = 'user_id';
    case app_id = 'app_id';
    case cluster_id = 'cluster_id';
}
