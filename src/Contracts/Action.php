<?php

namespace Bhdit\NovaNotifications\Contracts;

interface Action
{
    public function markAsRead(): Action;
    public function hidesNotification(): Action;
    public function toArray(): array;
}
