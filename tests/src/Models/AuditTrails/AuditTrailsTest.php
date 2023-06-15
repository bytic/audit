<?php

declare(strict_types=1);

namespace ByTIC\Audit\Tests\Models\AuditTrails;

use ByTIC\Audit\Models\AuditTrails\AuditTrail;
use ByTIC\Audit\Models\AuditTrails\AuditTrails;
use Nip\Database\Query\Insert;
use Nip\Records\AbstractModels\Record;

/**
 * Class AuditTrailTraitTest
 * @package ByTIC\Audit\Tests\Models\AuditTrails
 */
class AuditTrailsTest extends \ByTIC\Audit\Tests\AbstractTestCase
{
    public function test_getTable()
    {
        $repository = AuditTrails::instance();

        self::assertSame('audit-trails', $repository->getTable());
    }

}
