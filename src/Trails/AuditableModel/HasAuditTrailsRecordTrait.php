<?php

namespace ByTIC\Audit\Trails\AuditableModel;

use ByTIC\Audit\Trails\AuditTrailBuilder;

/**
 * Trait HasAuditableTrailsRecordTrait
 * @package ByTIC\Audit\Trails\AuditableModel
 *
 * @method getAuditTrails
 */
trait HasAuditTrailsRecordTrait
{
    /**
     * @param null $event
     * @return AuditTrailBuilder
     */
    public function addAuditTrail($event = null, $metadata = []): AuditTrailBuilder
    {
        return AuditTrailBuilder::for($this, $event)->withMetadata($metadata);
    }
}
