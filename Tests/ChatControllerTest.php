<?php declare(strict_types=1);

namespace App\Modules\Chats\Tests;

use App\Modules\Chats\Constants\RouteConstants;
use App\Modules\Chats\Database\Factories\ChatFactory;
use Tests\TestFeatureCase;
use Tests\Traits\Auth;
use Tests\Traits\Endpoints\ArchiveCase;
use Tests\Traits\Endpoints\DestroyCase;
use Tests\Traits\Endpoints\IndexCase;
use Tests\Traits\Endpoints\ListCase;
use Tests\Traits\Endpoints\RestoreCase;
use Tests\Traits\Endpoints\ShowCase;
use Tests\Traits\Endpoints\StoreCase;
use Tests\Traits\Endpoints\UpdateCase;

class ChatControllerTest extends TestFeatureCase
{
    use Auth;
    use IndexCase;
    use ListCase;
    use ShowCase;
    use StoreCase;
    use UpdateCase;
    use DestroyCase;
    use ArchiveCase;
    use RestoreCase;

    public string $factory = ChatFactory::class;
    public string $routes = RouteConstants::class;
}
