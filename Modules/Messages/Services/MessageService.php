<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\Messages\Services;

use App\Modules\Chats\Modules\Messages\Http\Requests\StoreRequest;
use App\Modules\Chats\Modules\Messages\Models\Message;
use Illuminate\Support\Facades\DB;

class MessageService
{
    public function create(StoreRequest $request): Message
    {
        return DB::transaction(function () use ($request): Message {
            $message = Message::create([
                ...$request->validated(),
                'user_id' => auth()->id(),
            ]);

            /* TODO temporary storage after documents will be merge */
            // $message->files()->sync($request->attachments_ids);

            $chat = $message->chat;

            $message->users()->sync(
                $chat->users->where('id', '!==', auth()->id()),
            );

            $chat->touch();

            return $message;
        });
    }
}
