<?php

namespace ByTIC\Audit\Tests\Trails;

use ByTIC\Audit\Models\AuditTrails\AuditTrail;
use ByTIC\Audit\Tests\AbstractTestCase;
use ByTIC\Audit\Tests\Fixtures\Models\Articles\Articles;
use ByTIC\Audit\Utility\AuditModels;


/**
 * Class AuditTrailsRecordTraitTest
 * @package ByTIC\Audit\Tests\Trails
 */
class AuditTrailsRecordTraitTest extends AbstractTestCase
{
    public function test_addAuditTrail()
    {
        $audit_repository = $this->getAuditTrailsMock();
        $audit_repository->shouldReceive('save')->once()->with(\Mockery::capture($trail));
        AuditModels::trails($audit_repository);

        $repository = Articles::instance();
        $article = $repository->getNew();
        $article->id = 99;
        $article->addAuditTrail();

        /** @var AuditTrail $trail */
        static::assertInstanceOf(AuditTrail::class, $trail);
        self::assertSame(99, $trail->model_id);
        self::assertSame('articles', $trail->model_type);

        unset($audit_repository);
        \Mockery::close();
    }

}
