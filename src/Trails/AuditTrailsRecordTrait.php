<?php

namespace ByTIC\Audit\Trails;

/**
 * Trait AuditTrailsRecordTrait
 * @package ByTIC\Audit\Trails
 */
trait AuditTrailsRecordTrait
{
    /**
     * @param null $event
     * @return AuditTrailBuilder
     */
    public function addAuditTrail($event = null): AuditTrailBuilder
    {
        return AuditTrailBuilder::for($this, $event);
    }
}
