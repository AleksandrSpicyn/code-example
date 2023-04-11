<?php declare(strict_types=1);

use App\Modules\Chats\Models\Chat;
use App\Modules\Users\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_user', function (Blueprint $table): void {
            $table
                ->foreignIdFor(Chat::class)
                ->constrained()
                ->cascadeOnDelete();

            $table
                ->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_user');
    }
};
