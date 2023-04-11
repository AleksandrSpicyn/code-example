<?php declare(strict_types=1);

namespace App\Modules\Chats\Models\Scopes;

use App\Modules\Chats\Constants\PermissionConstants as ChatPerm;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class HasAccess implements Scope
{
    public function __construct(private readonly string $relation)
    {
    }

    public function apply(Builder $builder, Model $model): void
    {
        if (!auth()->user()?->isAbleTo(ChatPerm::GLOBAL)) {
            $builder->whereRelation($this->relation, 'id', auth()->id());
        }
    }
}
