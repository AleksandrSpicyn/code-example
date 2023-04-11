<?php declare(strict_types=1);

namespace App\Modules\Chats\Database\Factories;

use App\Modules\Chats\Models\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    protected $model = Chat::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->jobTitle(),
        ];
    }
}
