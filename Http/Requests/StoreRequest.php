<?php declare(strict_types=1);

namespace App\Modules\Chats\Http\Requests;

use App\Http\Requests\Rules\MaxString;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => MaxString::required(),
            'lead_id' => 'nullable|integer|exists:leads,id',
        ];
    }
}
