<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\Messages\Http\Controllers;

use App\Modules\Chats\Models\Chat;
use App\Modules\Chats\Modules\Messages\Constants\EventConstants as Events;
use App\Modules\Chats\Modules\Messages\Events\ChatMessageReceived;
use App\Modules\Chats\Modules\Messages\Events\ChatMessageUpdated;
use App\Modules\Chats\Modules\Messages\Http\Requests\StoreRequest;
use App\Modules\Chats\Modules\Messages\Http\Requests\UpdateRequest;
use App\Modules\Chats\Modules\Messages\Models\Message;
use App\Modules\Chats\Modules\Messages\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MessageController
{
    public function store(StoreRequest $request, MessageService $service): Message
    {
        $message = $service->create($request);

        ChatMessageUpdated::broadcast($message)->toOthers();

        $message->users()->each([ChatMessageReceived::class, 'broadcast']);

        return $message->load('user', 'reply.user');
    }

    public function update(UpdateRequest $request, Message $message): void
    {
        $message->update($request->validated());

        ChatMessageUpdated::broadcast($message, Events::UPDATED)->toOthers();
    }

    public function archive(Message $message): void
    {
        $message->delete();

        ChatMessageUpdated::broadcast($message, Events::ARCHIVED)->toOthers();
    }

    public function unreadList(Request $request): Collection
    {
        return auth()
            ->user()
            ?->unreadMessages()
            ->with('chat', 'user')
            ->orderByRequest($request, 'created_at', 'desc')
            ->get();
    }

    public function read(Chat $chat): void
    {
        auth()
            ->user()
            ?->unreadMessages()
            ->whereRelation('chat', 'id', $chat->id)
            ->update(['read_at' => now()]);
    }
}
