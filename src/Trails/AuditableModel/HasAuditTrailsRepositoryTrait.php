<?php

namespace ByTIC\Audit\Trails\AuditableModel;

use ByTIC\Audit\Utility\AuditModels;

/**
 * Trait HasAuditableTrailsRepositoryTrait
 * @package ByTIC\Audit\Trails\AuditableModel
 */
trait HasAuditTrailsRepositoryTrait
{

    public function bootAuditTrailsRepositoryTrait()
    {
        $this->initRelations();
        $this->morphMany('AuditTrails', ['class' => get_class(AuditModels::trails()), 'morphPrefix' => 'model']);
    }
}