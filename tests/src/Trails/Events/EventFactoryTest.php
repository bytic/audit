<?php

namespace ByTIC\Audit\Tests\Trails\Events;

use ByTIC\Audit\Tests\AbstractTestCase;
use ByTIC\Audit\Trails\Events\Event;
use ByTIC\Audit\Trails\Events\EventFactory;
use Mockery;

/**
 * Class EventFactoryTest
 * @package ByTIC\Audit\Tests\Trails\Events
 */
class EventFactoryTest extends AbstractTestCase
{
    public function test_for()
    {
        $audit_repository = $this->getAuditTrailsMock();
        $trail = $audit_repository->getNew(['event' => 'test']);

        $event = EventFactory::for($trail);
        self::assertInstanceOf(Event::class, $event);
        self::assertSame('test', $event->getName());
    }
}
