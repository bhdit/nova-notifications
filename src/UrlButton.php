<?php

namespace Bhdit\NovaNotifications;

use Bhdit\NovaNotifications\Contracts\Action;

class UrlButton implements Action
{
    protected $properties = [];

    public function __construct(string $label, string $url)
    {
        $this->properties = compact('label', 'url');
        $this->properties['type'] = 'url';
    }

    public function toArray(): array
    {
        return $this->properties;
    }
}
