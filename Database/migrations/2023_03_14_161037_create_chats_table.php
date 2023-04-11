<?php declare(strict_types=1);

use App\Modules\Leads\Models\Lead;
use App\Modules\Users\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table): void {
            $table->id();

            /* TODO Maybe need not nullable, if there are no chats without deals */
            $table
                ->foreignIdFor(Lead::class)
                ->nullable()
                ->constrained()
                ->restrictOnDelete();

            /* TODO Maybe need not nullable, if there are no system messages */
            $table
                ->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
                ->restrictOnDelete();

            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
