<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\ChatUsers\Constants;

use App\Modules\Chats\Constants\RouteConstants as ParentConstants;

class RouteConstants
{
    public const PREFIX = 'users';

    public const NAME_PREFIX = ParentConstants::PREFIX . '.' . self::PREFIX;

    public const LIST = self::NAME_PREFIX . '.list';
    public const DETACH = self::NAME_PREFIX . '.detach';
    public const SYNC = self::NAME_PREFIX . '.sync';
}
