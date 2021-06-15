<?php

namespace ByTIC\Audit\Trails;

use ByTIC\Audit\Utility\AuditModels;

/**
 * Trait AuditTrailsRepositoryTrait
 * @package ByTIC\Audit\Trails
 */
trait AuditTrailsRepositoryTrait
{

    public function bootAuditTrailsRepositoryTrait()
    {
        $this->initRelations();
        $this->morphMany('AuditTrails', ['class' => get_class(AuditModels::trails()), 'morphPrefix' => 'model']);
    }
}