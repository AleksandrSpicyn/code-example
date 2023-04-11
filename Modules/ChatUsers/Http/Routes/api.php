<?php declare(strict_types=1);

use App\Modules\Chats\Modules\ChatUsers\Constants\RouteConstants as Names;
use App\Modules\Chats\Modules\ChatUsers\Http\Controllers\ChatUserController;

Route
    ::middleware('permissions')
    ->controller(ChatUserController::class)
    ->prefix('{chat}/users')
    ->group(function (): void {
        Route::get('', 'list')->name(Names::LIST);
        Route::patch('', 'sync')->name(Names::SYNC);
        Route::delete('{user}', 'detach')->name(Names::DETACH);
    });
