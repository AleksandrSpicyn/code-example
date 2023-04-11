<?php declare(strict_types=1);

namespace App\Modules\Chats\Services;

use App\Modules\Chats\DTO\ListRequestDTO;
use App\Modules\Chats\Models\Chat;
use Illuminate\Database\Eloquent\Builder;

final class ChatService
{
    public function getListQuery(ListRequestDTO $dto): Builder
    {
        return Chat::search($dto->search, ['name']);
    }
}
