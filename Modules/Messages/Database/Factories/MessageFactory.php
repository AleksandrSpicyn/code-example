<?php declare(strict_types=1);

namespace App\Modules\Chats\Modules\Messages\Database\Factories;

use App\Modules\Chats\Database\Factories\ChatFactory;
use App\Modules\Chats\Modules\Messages\Models\Message;
use App\Modules\Users\Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->text(),
            'chat_id' => new ChatFactory(),
            'user_id' => new UserFactory(),
        ];
    }
}
