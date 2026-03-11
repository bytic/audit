<?php

namespace ByTIC\Audit\Tests\Trails\Events;

use ByTIC\Audit\Models\AuditTrails\AuditTrail;
use ByTIC\Audit\Tests\AbstractTestCase;
use ByTIC\Audit\Tests\Fixtures\Models\Articles\Articles;
use ByTIC\Audit\Trails\Events\AbstractEvent;
use ByTIC\Audit\Trails\Events\Event;
use ByTIC\Audit\Utility\AuditModels;

/**
 * Class AbstractEventTest
 * @package ByTIC\Audit\Tests\Trails\Events
 */
class AbstractEventTest extends AbstractTestCase
{
    public function test_addTrail_returns_builder()
    {
        $audit_repository = $this->getAuditTrailsMock();
        $audit_repository->shouldReceive('save')->once()->with(\Mockery::capture($trail));
        AuditModels::trails($audit_repository);

        $repository = Articles::instance();
        $article = $repository->getNew();
        $article->id = 99;

        Event::addTrail($article);

        /** @var AuditTrail $trail */
        self::assertInstanceOf(AuditTrail::class, $trail);
        self::assertSame(99, $trail->model_id);
        self::assertSame('articles', $trail->model_type);
    }

    public function test_addTrail_with_metadata()
    {
        $audit_repository = $this->getAuditTrailsMock();
        $audit_repository->shouldReceive('save')->once()->with(\Mockery::capture($trail));
        AuditModels::trails($audit_repository);

        $repository = Articles::instance();
        $article = $repository->getNew();
        $article->id = 99;

        Event::addTrail($article, ['key' => 'value']);

        /** @var AuditTrail $trail */
        self::assertInstanceOf(AuditTrail::class, $trail);
        self::assertSame('value', $trail->metadata->get('key'));
    }

    public function test_addTrail_uses_getEventName()
    {
        $audit_repository = $this->getAuditTrailsMock();
        $audit_repository->shouldReceive('save')->once()->with(\Mockery::capture($trail));
        AuditModels::trails($audit_repository);

        $repository = Articles::instance();
        $article = $repository->getNew();
        $article->id = 99;

        $customEvent = new class extends AbstractEvent {
            public static function getEventName(): ?string
            {
                return self::CREATE;
            }

            public function getFormattedMessage(): string
            {
                return 'created';
            }
        };

        $customEvent::addTrail($article);

        /** @var AuditTrail $trail */
        self::assertInstanceOf(AuditTrail::class, $trail);
        self::assertSame(AbstractEvent::CREATE, $trail->getPropertyRaw('event'));
    }

    public function test_getEventName_returns_null_by_default()
    {
        self::assertNull(Event::getEventName());
    }
}
