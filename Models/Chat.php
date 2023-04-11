<?php declare(strict_types=1);

namespace App\Modules\Chats\Models;

use App\Models\AuditableModel;
use App\Modules\Chats\Models\Scopes\HasAccess;
use App\Modules\Chats\Modules\Messages\Models\Message;
use App\Modules\Leads\Models\Lead;
use App\Modules\Users\Models\User;
use App\Modules\Users\Traits\HasUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends AuditableModel
{
    use SoftDeletes;
    use HasUser;

    protected $fillable = [
        'name',
        'lead_id',
        'user_id',
    ];

    public static function booted(): void
    {
        static::addGlobalScope(new HasAccess('users'));
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
