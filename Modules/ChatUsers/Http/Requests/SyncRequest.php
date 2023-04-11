<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\ChatUsers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SyncRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_ids' => 'required|array|exists:users,id',
        ];
    }
}
