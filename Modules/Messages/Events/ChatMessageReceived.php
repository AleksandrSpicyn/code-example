<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\Messages\Events;

use App\Modules\Chats\Modules\Messages\Constants\EventConstants;
use App\Modules\Users\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

class ChatMessageReceived implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private readonly User $user)
    {
    }

    public function broadcastAs(): string
    {
        return EventConstants::RECEIVED;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel("communication-channel.{$this->user->id}");
    }
}
