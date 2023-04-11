<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\Messages\Constants;

class EventConstants
{
    public const PREFIX = 'chat.message';

    public const NEW = self::PREFIX . '.new';
    public const UPDATED = self::PREFIX . '.updated';
    public const ARCHIVED = self::PREFIX . '.archived';
    public const RECEIVED = self::PREFIX . '.received';
}
