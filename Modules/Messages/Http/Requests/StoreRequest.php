<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\Messages\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => 'nullable|string',
            'chat_id' => 'required|integer|exists:chats,id',
            'reply_id' => 'nullable|integer|exists:messages,id',
            'attachments_ids' => 'nullable|array|exists:files,id',
        ];
    }
}
