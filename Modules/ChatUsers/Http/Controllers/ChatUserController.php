<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\ChatUsers\Http\Controllers;

use App\Modules\Chats\Events\ChatUpdated;
use App\Modules\Chats\Models\Chat;
use App\Modules\Chats\Modules\ChatUsers\Constants\EventConstants as Events;
use App\Modules\Chats\Modules\ChatUsers\Http\Requests\SyncRequest;
use App\Modules\Users\Models\User;
use Illuminate\Support\Collection;

class ChatUserController
{
    public function list(Chat $chat): Collection
    {
        return $chat
            ->users()
            ->with(
                'accounts',
                'phones',
                'addresses',
                'organisations',
            )
            ->get();
    }

    public function sync(Chat $chat, SyncRequest $request): void
    {
        $chat->users()->sync($request->user_ids, false);

        ChatUpdated::broadcast($chat, Events::UPDATED)->toOthers();
    }

    public function detach(Chat $chat, User $user): void
    {
        $chat->users()->detach($user);

        ChatUpdated::broadcast($chat, Events::UPDATED)->toOthers();
    }
}
