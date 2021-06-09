<?php

namespace ByTIC\Audit\Trails;

use ByTIC\Audit\Models\AuditTrails\AuditTrail;
use ByTIC\Audit\Utility\AuditModels;
use Nip\Http\Request;
use Nip\Utility\Date;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AuditTrailBuilder
 * @package ByTIC\Audit\Trails
 */
class AuditTrailBuilder
{
    /**
     * @var AuditTrail
     */
    protected $trail;

    public static function for($model, $event = null): AuditTrailBuilder
    {
        $builder = new static();
        $builder->forModel($model);
        $builder->withEvent($event);
        $builder->initTimestamps();
        $builder->initRequest();
        return $builder;
    }

    /**
     * AuditTrailBuilder constructor.
     */
    protected function __construct()
    {
        $this->trail = AuditModels::trails()->getNew();
    }

    /**
     * @param $model
     * @return AuditTrailBuilder
     */
    public function forModel($model): AuditTrailBuilder
    {
        $this->trail->populateFromModel($model);
        return $this;
    }

    /**
     * @param $event
     */
    public function withEvent($event)
    {
        $this->trail->setEvent($event);
    }

    /**
     * @param Request $request
     */
    public function populateFromRequest(ServerRequestInterface $request)
    {
        $this->trail->user_ip = $request->getClientIp();
        $this->trail->user_agent = $request->headers->get('User-Agent');
    }

    public function save()
    {
        $this->trail->save();
    }

    public function __destruct()
    {
        $this->save();
    }

    protected function initTimestamps()
    {
        $now = Date::now();
        $this->trail->performed_at = $now;
        $this->trail->created_at = $now;
    }

    protected function initRequest()
    {
        if (!function_exists('request')) {
            return;
        }
        $request = request();
        $this->populateFromRequest($request);
    }
}