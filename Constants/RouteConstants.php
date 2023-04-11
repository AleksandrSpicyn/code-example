<?php declare(strict_types=1);

namespace App\Modules\Chats\Constants;

class RouteConstants
{
    public const PREFIX = 'chats';

    public const INDEX = self::PREFIX . '.index';
    public const LIST = self::PREFIX . '.list';
    public const STORE = self::PREFIX . '.store';
    public const SHOW = self::PREFIX . '.show';
    public const UPDATE = self::PREFIX . '.update';
    public const ARCHIVE = self::PREFIX . '.archive';
    public const RESTORE = self::PREFIX . '.restore';
    public const DESTROY = self::PREFIX . '.destroy';
}
