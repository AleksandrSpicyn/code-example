<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\ChatUsers\Tests;

use App\Modules\Chats\Database\Factories\ChatFactory;
use App\Modules\Chats\Modules\ChatUsers\Constants\RouteConstants;
use App\Modules\Users\Database\Factories\UserFactory;
use Tests\TestFeatureCase;
use Tests\Traits\Auth;

class ChatUserControllerTest extends TestFeatureCase
{
    use Auth;

    public function test_list(): void
    {
        $chat = ChatFactory::new()->create();
        $users = UserFactory::new()->count(5)->create();

        $chat->users()->attach($users);

        $response = $this->getJson(
            route(RouteConstants::LIST, $chat),
        );

        $response->assertOk();
    }

    public function test_sync(): void
    {
        $chat = ChatFactory::new()->create();
        $users = UserFactory::new()->count(5)->create();

        $response = $this->patchJson(
            route(RouteConstants::SYNC, $chat),
            ['user_ids' => $users->pluck('id')],
        );

        $response->assertOk();

        $this->assertDatabaseHas('chat_user', [
            'chat_id' => $chat->id,
            'user_id' => $users->value('id'),
        ]);
    }

    public function test_detach(): void
    {
        $chat = ChatFactory::new()->create();
        $users = UserFactory::new()->count(5)->create();
        $user = $users->first();

        $chat->users()->attach($users);

        $response = $this->deleteJson(
            route(RouteConstants::DETACH, [$chat, $user]),
        );

        $response->assertOk();

        $this->assertDatabaseMissing('chat_user', [
            'chat_id' => $chat->id,
            'user_id' => $user->id,
        ]);
    }
}
