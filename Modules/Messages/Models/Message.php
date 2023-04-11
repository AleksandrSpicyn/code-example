<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\Messages\Models;

use App\Models\AuditableModel;
use App\Modules\Chats\Models\Chat;
use App\Modules\Chats\Models\Scopes\HasAccess;
use App\Modules\Files\Traits\HasFile;
use App\Modules\Users\Models\User;
use App\Modules\Users\Traits\HasUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends AuditableModel
{
    use SoftDeletes;
    use HasFile;
    use HasUser;

    protected $fillable = [
        'content',
        'chat_id',
        'user_id',
        'reply_id',
    ];

    public static function booted(): void
    {
        static::addGlobalScope(new HasAccess('chat.users'));
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    public function reply(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function users(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class)
            ->withPivot('read_at');
    }
}
