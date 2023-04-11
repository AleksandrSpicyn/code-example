<?php declare(strict_types=1);

namespace App\Modules\Chats\Http\Requests;

use App\Modules\Chats\DTO\ListRequestDTO;
use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => 'nullable|string',
        ];
    }

    public function toDTO(): ListRequestDTO
    {
        return ListRequestDTO::make($this->validated());
    }
}
