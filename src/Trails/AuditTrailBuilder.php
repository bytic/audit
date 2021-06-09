<?php

namespace ByTIC\Audit\Trails;

use ByTIC\Audit\Models\AuditTrails\AuditTrail;
use ByTIC\Audit\Utility\AuditModels;

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

    public function save()
    {
        $this->trail->save();
    }

    public function __destruct()
    {
        $this->save();
    }
}