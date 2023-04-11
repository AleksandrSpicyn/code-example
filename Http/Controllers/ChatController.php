<?php declare(strict_types=1);

namespace App\Modules\Chats\Http\Controllers;

use App\Modules\Chats\Http\Requests\ListRequest;
use App\Modules\Chats\Http\Requests\StoreRequest;
use App\Modules\Chats\Http\Requests\UpdateRequest;
use App\Modules\Chats\Models\Chat;
use App\Modules\Chats\Services\ChatService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ChatController
{
    public function __construct(private readonly ChatService $service)
    {
    }

    public function index(ListRequest $request): LengthAwarePaginator
    {
        return $this
            ->service
            ->getListQuery($request->toDTO())
            ->orderByRequest($request, 'updated_at')
            ->paginate();
    }

    public function list(ListRequest $request): Collection
    {
        return $this
            ->service
            ->getListQuery($request->toDTO())
            ->get();
    }

    public function show(Chat $chat): Chat
    {
        return $chat->load(
            'messages.files',
            'messages.reply.user',
            'messages.user',
            'users.accounts',
            'users.phones',
            'users.addresses',
            'users.organisations',
        );
    }

    public function store(StoreRequest $request): void
    {
        DB::transaction(function () use ($request): void {
            Chat
                ::create($request->validated())
                ->users()
                ->sync(auth()->id());
        });
    }

    public function update(UpdateRequest $request, Chat $chat): void
    {
        $chat->update($request->validated());
    }

    public function archive(Chat $chat): void
    {
        $chat->delete();
    }

    public function restore(Chat $chat): void
    {
        $chat->restore();
    }

    public function destroy(Chat $chat): void
    {
        $chat->forceDelete();
    }
}
