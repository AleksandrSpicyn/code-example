<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\Messages\Events;

use App\Modules\Chats\Modules\Messages\Constants\EventConstants;
use App\Modules\Chats\Modules\Messages\Http\Resources\MessageResource;
use App\Modules\Chats\Modules\Messages\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageUpdated implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public MessageResource $data;

    public function __construct(
        private readonly Message $message,
        private readonly string $type = EventConstants::NEW,
    ) {
        $this->data = new MessageResource($this->message);
    }

    public function broadcastAs(): string
    {
        return $this->type;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel("chat.{$this->message->chat_id}");
    }
}
