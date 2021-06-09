<?php

namespace ByTIC\Audit\Tests\Models\AuditTrails;

use ByTIC\Audit\Models\AuditTrails\AuditTrail;
use ByTIC\Audit\Models\AuditTrails\AuditTrails;
use Nip\Database\Query\Insert;
use Nip\Records\AbstractModels\Record;

/**
 * Class AuditTrailTraitTest
 * @package ByTIC\Audit\Tests\Models\AuditTrails
 */
class AuditTrailTraitTest extends \ByTIC\Audit\Tests\AbstractTestCase
{

    public function test_cast_metadata()
    {
        $item = new AuditTrail();

        $metadata = $item->metadata;
        self::assertInstanceOf(\ByTIC\DataObjects\Casts\Metadata\Metadata::class, $metadata);

        $item->addMedata('test', 99);
        self::assertSame(99, $item->metadata['test']);

        self::assertSame('{"test":99}', $item->getPropertyRaw('metadata'));
    }

    public function test_cast_metadata_empty()
    {
        $repository = \Mockery::mock(AuditTrails::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $repository->shouldReceive('insertQuery')->once()->andReturn(new Insert());
        $repository->shouldReceive('performInsert')->once();
        $repository->bootAuditTrailsTrait();

        $item = new AuditTrail();
        $item->setManager($repository);
        $item->insert();

        self::assertSame('{}', $item->getPropertyRaw('metadata'));
    }
}