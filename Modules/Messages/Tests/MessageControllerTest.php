<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\Messages\Tests;

use App\Modules\Chats\Modules\Messages\Constants\RouteConstants;
use App\Modules\Chats\Modules\Messages\Database\Factories\MessageFactory;
use App\Modules\Chats\Modules\Messages\Models\Message;
use Tests\TestFeatureCase;
use Tests\Traits\Auth;
use Tests\Traits\Endpoints\ArchiveCase;

class MessageControllerTest extends TestFeatureCase
{
    use Auth;
    use ArchiveCase;

    public string $factory = MessageFactory::class;
    public string $routes = RouteConstants::class;

    public function test_store(): void
    {
        $item = $this->factory()->make();

        $payload = $item->only($item->getFillable());

        $this
            ->postJson(
                route(RouteConstants::STORE, $payload),
            )
            ->assertCreated();

        $this->assertDatabaseHas($item, [
            ...$payload,
            'user_id' => $this->authUser->id,
        ]);
    }

    public function test_update(): void
    {
        $item = $this->factory()->create();
        $newItem = $this->factory()->make();
        $payload = $newItem->only('content');

        $this
            ->putJson(
                route(RouteConstants::UPDATE, $item),
                $payload,
            )
            ->assertOk();

        $this->assertDatabaseHas($item, $payload);
    }

    public function test_unread_list(): void
    {
        $items = $this->factory()->count(5)->create();

        $items->each(
            fn(Message $message): array => $message->users()->sync($this->authUser->id),
        );

        $this
            ->getJson(
                route(RouteConstants::UNREAD_LIST),
            )
            ->assertOk();
    }

    public function test_read(): void
    {
        $item = $this->factory()->create();

        $item->users()->sync($this->authUser->id);

        $this
            ->patchJson(
                route(RouteConstants::READ, $item->chat_id),
            )
            ->assertOk();
    }
}
