<?php

namespace ByTIC\Audit\Utility;

use ByTIC\Audit\Models\AuditTrails\AuditTrails;
use Nip\Records\Locator\ModelLocator;

/**
 * Class AuditModels
 * @package ByTIC\Audit\Utility
 */
class AuditModels
{
    protected static $models = [];

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

    protected static function setModels($type, $repository)
    {
        static::$models[$type] = $repository;
    }


    /**
     * @param string $type
     * @param string $default
     * @return mixed|\Nip\Records\AbstractModels\RecordManager
     */
    protected static function getModels($type, $default)
    {
        if (!isset(static::$models[$type])) {
            $modelManager = static::getConfigVar($type, $default);
            return static::$models[$type] = ModelLocator::get($modelManager);
        }

        return static::$models[$type];
    }

    /**
     * @param string $type
     * @param null|string $default
     * @return string
     */
    protected static function getConfigVar($type, $default = null)
    {
        if (!function_exists('config')) {
            return $default;
        }
        $varName = 'payments.models.' . $type;
        $config = config();
        if ($config->has($varName)) {
            return $config->get($varName);
        }
        return $default;
    }
}
