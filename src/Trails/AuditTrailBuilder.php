<?php

namespace ByTIC\Audit\Trails;

use ByTIC\Audit\Models\AuditTrails\AuditTrail;
use ByTIC\Audit\Utility\AuditModels;
use ByTIC\Auth\AuthManager;
use Nip\Http\Request;
use Nip\Records\AbstractModels\Record;
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
        $builder->withUser(null);

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
     * @return self
     */
    public function forModel($model): self
    {
        $this->trail->populateFromModel($model);
        return $this;
    }

    /**
     * @param ?Record $user
     * @return self
     */
    public function withUser($user): self
    {
        $this->trail->populateFromUser($user);
        return $this;
    }

    /**
     * @param $event
     * @return self
     */
    public function withEvent($event): self
    {
        $this->trail->setEvent($event);
        return $this;
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