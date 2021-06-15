<?php

namespace ByTIC\Audit\Models\AuditTrails;

use Nip\Records\Record;

/**
 * Class AuditTrail
 * @package ByTIC\Audit\Models\AuditTrails
 */
class AuditTrail extends Record
{
    use AuditTrailTrait;
}
