<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\Messages\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => 'required|string',
        ];
    }
}
