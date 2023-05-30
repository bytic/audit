<?php

declare(strict_types=1);

namespace ByTIC\Audit\Utility;

use ByTIC\Audit\AuditServiceProvider;
use Exception;

/**
 *
 */
class PackageConfig extends \ByTIC\PackageBase\Utility\PackageConfig
{
    protected $name = AuditServiceProvider::NAME;

    public static function configPath(): string
    {
        return __DIR__ . '/../../config/audit.php';
    }


    /**
     * @return string|null
     * @throws Exception
     */
    public static function databaseConnection(): ?string
    {
        return (string)static::instance()->get('database.connection');
    }

    public static function shouldRunMigrations(): bool
    {
        return static::instance()->get('database.migrations', false) !== false;
    }
}
