<?php

namespace Bhdit\NovaNotifications;

use Bhdit\NovaNotifications\Contracts\Action;

abstract class BaseAction implements Action
{
    protected $properties = [];

    public function markAsRead(): Action
    {
        $this->properties['markAsRead'] = true;

        return $this;
    }

    public function hidesNotification(): Action
    {
        $this->properties['hidesNotification'] = true;

        return $this;
    }
}
