<?php declare(strict_types=1);

namespace App\Modules\Chats\DTO;

use App\Traits\DTOTrait;

class ListRequestDTO
{
    use DTOTrait;

    public ?string $search = null;
}
