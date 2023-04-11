<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\Messages\Constants;

use App\Modules\Chats\Constants\RouteConstants as ParentConstants;

class RouteConstants
{
    public const PREFIX = 'messages';

    public const NAME_PREFIX = ParentConstants::PREFIX . '.' . self::PREFIX;

    public const STORE = self::NAME_PREFIX . '.store';
    public const UPDATE = self::NAME_PREFIX . '.update';
    public const ARCHIVE = self::NAME_PREFIX . '.archive';
    public const UNREAD_LIST = self::NAME_PREFIX . '.unread-list';
    public const READ = self::NAME_PREFIX . '.read';
}
