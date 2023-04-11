<?php declare(strict_types=1);

use App\Modules\Chats\Modules\Messages\Models\Message;
use App\Modules\Users\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('message_user', function (Blueprint $table): void {
            $table
                ->foreignIdFor(Message::class)
                ->constrained()
                ->cascadeOnDelete();

            $table
                ->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->dateTime('read_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_user');
    }
};
