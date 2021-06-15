<?php

namespace ByTIC\Audit\Trails\Events;

/**
 * Class Event
 * @package ByTIC\Audit\Trails\Events
 */
class Event extends AbstractEvent
{
    public function getFormattedMessage(): string
    {
        return $this->getName();
    }
}
