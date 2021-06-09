<?php

use ByTIC\Audit\Models\AuditTrails\AuditTrails;

return [
    'models' => [
        'trails' => AuditTrails::class
    ],

    'tables' => [
        'trails' => AuditTrails::TABLE,
    ],
];
