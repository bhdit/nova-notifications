<?php

use Illuminate\Support\Facades\Route;

Route::get(
    '/unread',
    config(
        'nova-notifications.controllers.list_unread_notifications',
        \Bhdit\NovaNotifications\Http\Controllers\GetAllUnreadController::class
    )
);

Route::patch(
    '/{notification}',
    config(
        'nova-notifications.controllers.mark_as_read',
        \Bhdit\NovaNotifications\Http\Controllers\MarkAsReadController::class
    )
);
Route::patch(
    '/',
    config(
        'nova-notifications.controllers.mark_all_as_read',
        \Bhdit\NovaNotifications\Http\Controllers\MarkAllAsReadController::class
    )
);
