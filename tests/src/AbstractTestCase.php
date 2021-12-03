<?php

namespace ByTIC\Audit\Tests;

use ByTIC\Audit\Models\AuditTrails\AuditTrail;
use ByTIC\Audit\Models\AuditTrails\AuditTrails;
use ByTIC\Audit\Utility\AuditModels;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Nip\Records\Locator\ModelLocator;

/**
 * Class AbstractTestCase
 * @package ByTIC\Payments\Tests
 */
abstract class AbstractTestCase extends \PHPUnit\Framework\TestCase
{
    use MockeryPHPUnitIntegration;

    public function tearDown(): void
    {
        parent::tearDown();
        AuditModels::reset();
    }

    /**
     * @return \Mockery\Mock|AuditTrails
     */
    protected function getAuditTrailsMock()
    {
        $audit_repository = \Mockery::mock(AuditTrails::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $audit_repository->shouldReceive('getPrimaryKey')->andReturn('id');
        $audit_repository->shouldReceive('getModel')->andReturn(AuditTrail::class);

        return $audit_repository;
    }
}
