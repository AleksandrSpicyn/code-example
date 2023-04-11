<?php declare(strict_types=1);

namespace App\Modules\Chats\Events;

use App\Modules\Chats\Models\Chat;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

class ChatUpdated implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;

    public Chat $data;

    public function __construct(
        private readonly Chat $chat,
        private readonly string $type,
    ) {
        $this->data = $chat;
    }

    public function broadcastAs(): string
    {
        return $this->type;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel("chat.{$this->chat->id}");
    }
}
