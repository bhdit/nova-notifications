<?php

namespace Bhdit\NovaNotifications;

class UrlButton extends BaseAction
{

    public function __construct(string $label, string $url)
    {
        $this->properties = compact('label', 'url');
        $this->properties['type'] = 'url';
    }

    public function classes(string $classes): UrlButton
    {
        $this->properties['classes'] = $classes;
        return $this;
    }

    public function toArray(): array
    {
        return $this->properties;
    }
}
