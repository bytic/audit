<?php

declare(strict_types=1);

namespace ByTIC\Audit\Utility;

use ByTIC\Audit\AuditServiceProvider;
use ByTIC\Audit\Models\AuditTrails\AuditTrails;
use ByTIC\PackageBase\Utility\ModelFinder;

/**
 * Class AuditModels
 * @package ByTIC\Audit\Utility
 */
class AuditModels extends ModelFinder
{
    /**
     * @return void
     */
    public static function reset(): void
    {
        static::$models = [];
    }

    /**
     * @return AuditTrails
     */
    public static function trails($repository = null)
    {
        if ($repository) {
            static::setModels('trails', $repository);
        }
        return static::getModels('trails', AuditTrails::class);
    }

    public static function trailsTable(): string
    {
        return static::getTable('trails', AuditTrails::TABLE);
    }

    protected static function setModels($type, $repository)
    {
        static::$models[$type] = $repository;
    }

    protected static function packageName(): string
    {
        return AuditServiceProvider::NAME;
    }
}
