<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\Messages\Http\Resources;

use App\Modules\Chats\Modules\Messages\Models\Message;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Message */
class MessageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            ...$this->only(
                'id',
                'content',
                'chat_id',
                'user_id',
                'reply_id',
                'created_at',
            ),
            'user' => $this->user,
            'reply' => $this->reply,
        ];
    }
}
