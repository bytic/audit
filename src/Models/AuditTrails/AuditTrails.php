<?php

namespace ByTIC\Audit\Models\AuditTrails;

use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class AuditTrails
 * @package ByTIC\Audit\Models\AuditTrails
 */
class AuditTrails extends RecordManager
{
    public const TABLE = 'audit-trails';

    use SingletonTrait;
    use AuditTrailsTrait;

    /**
     * @inheritDoc
     */
    public function getRootNamespace()
    {
        return 'ByTIC\Audit\Models\AuditTrails\\';
    }
}