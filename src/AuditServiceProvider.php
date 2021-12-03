<?php

namespace ByTIC\Audit;

use ByTIC\Audit\Utility\PackageConfig;
use ByTIC\PackageBase\BaseBootableServiceProvider;

/**
 * Class AuditServiceProvider
 * @package ByTIC\Audit
 */
class AuditServiceProvider extends BaseBootableServiceProvider
{
    public const NAME = 'audit';

    /**
     * @inheritdoc
     */
    public function register()
    {
    }

    /**
     * @inheritdoc
     */
    public function provides()
    {
        return [];
    }

    public function migrations(): ?string
    {
        if (PackageConfig::shouldRunMigrations()) {
            return dirname(__DIR__) . '/migrations/';
        }

        return null;
    }

//    protected function registerCommands()
//    {
//        $this->commands(
//            SessionsCleanup::class,
//            SubscriptionsCharge::class
//        );
//    }
}
