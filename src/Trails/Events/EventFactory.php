<?php

namespace ByTIC\Audit\Trails\Events;

use ByTIC\Audit\Models\AuditTrails\AuditTrail;

/**
 * Class EventFactory
 * @package ByTIC\Audit\Trails\Events
 */
class EventFactory
{
    /**
     * @param AuditTrail $trail
     * @return Event
     */
    public static function for($trail): Event
    {
        $class = static::eventClass($trail);
        /** @var Event $event */
        $event = new $class();
        $event->setTrail($trail->getA);
        $event->setName($trail->getPropertyRaw('event'));
        return $event;
    }

    /**
     * @param AuditTrail $trail
     * @return string
     */
    public static function eventClass($trail): string
    {
        $repository = $trail->getManager();

        if (method_exists($repository, 'getAuditTrailEventClass')) {
            return $repository->getAuditTrailEventClass($trail);
        }

        return Event::class;
    }
}