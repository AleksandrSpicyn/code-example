<?php declare(strict_types=1);

use App\Modules\Chats\Modules\Messages\Constants\RouteConstants as Names;
use App\Modules\Chats\Modules\Messages\Http\Controllers\MessageController;

Route
    ::controller(MessageController::class)
    ->middleware('permissions')
    ->group(function (): void {
        Route::get('unread-list', 'unreadList')->name(Names::UNREAD_LIST);
        Route::patch('{chat}/read', 'read')->name(Names::READ);
    });
