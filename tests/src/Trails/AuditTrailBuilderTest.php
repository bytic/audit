<?php

namespace ByTIC\Audit\Tests\Trails;

use ByTIC\Audit\Models\AuditTrails\AuditTrail;
use ByTIC\Audit\Tests\AbstractTestCase;
use ByTIC\Audit\Tests\Fixtures\Models\Articles\Articles;
use ByTIC\Audit\Trails\AuditTrailBuilder;
use ByTIC\Audit\Utility\AuditModels;

/**
 * Class AuditTrailBuilderTest
 * @package ByTIC\Audit\Tests\Trails
 */
class AuditTrailBuilderTest extends AbstractTestCase
{
    public function test_timestamps_default()
    {
        $audit_repository = $this->getAuditTrailsMock();
        $audit_repository->shouldReceive('save')->with(\Mockery::capture($trail));
        AuditModels::trails( $audit_repository);

        $repository = Articles::instance();
        $article = $repository->getNew();
        $article->id = 99;

        AuditTrailBuilder::for($article);

        /** @var AuditTrail $trail */
        static::assertInstanceOf(AuditTrail::class, $trail);
    }
}