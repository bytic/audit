<?php

namespace ByTIC\Audit\Tests\Trails;

use ByTIC\Audit\Models\AuditTrails\AuditTrail;
use ByTIC\Audit\Tests\AbstractTestCase;
use ByTIC\Audit\Tests\Fixtures\Models\Articles\Articles;
use ByTIC\Audit\Trails\AuditTrailBuilder;
use ByTIC\Audit\Utility\AuditModels;
use Nip\Container\Container;
use Nip\Http\Request;
use Nip\Utility\Date;
use Symfony\Component\HttpFoundation\HeaderBag;

/**
 * Class AuditTrailBuilderTest
 * @package ByTIC\Audit\Tests\Trails
 */
class AuditTrailBuilderTest extends AbstractTestCase
{
    public function test_request_default()
    {
        $request = \Mockery::mock(Request::class)->makePartial();
        $request->shouldReceive('getClientIp')->andReturn('1.1.1.1');
        $request->headers = new HeaderBag(['User-Agent' => 'Browser']);
        Container::getInstance()->set('request', $request);

        $trail = $this->buildTrailMock();

        self::assertSame('1.1.1.1', $trail->getPropertyRaw('user_ip'));
        self::assertSame('Browser', $trail->getPropertyRaw('user_agent'));
    }

    public function test_timestamps_default()
    {
        $trail = $this->buildTrailMock();

        /** @var AuditTrail $trail */
        static::assertInstanceOf(AuditTrail::class, $trail);

        $now = Date::now();
        self::assertSame($now->toDateTimeString(), $trail->getPropertyRaw('performed_at'));
        self::assertSame($now->toDateTimeString(), $trail->getPropertyRaw('created_at'));
    }

    /**
     * @return mixed
     */
    protected function buildTrailMock()
    {
        $audit_repository = $this->getAuditTrailsMock();
        $audit_repository->shouldReceive('save')->with(\Mockery::capture($trail));
        AuditModels::trails( $audit_repository);

        $repository = Articles::instance();
        $article = $repository->getNew();
        $article->id = 99;

        AuditTrailBuilder::for($article);
        return $trail;
    }
}