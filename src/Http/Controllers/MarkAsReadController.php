<?php


namespace Bhdit\NovaNotifications\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MarkAsReadController
{
    public function __invoke(Request $request, $notification)
    {
        $markRead = optional(
            $request
                ->user()
                ->unreadNotifications()
                ->find($notification)
        )->markAsRead();

        return Response::json([
            'notification' => $request
                ->user()
                ->notifications()
                ->find($notification),
        ]);
    }
}
