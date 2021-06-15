<?php

namespace ByTIC\Audit;

use Nip\Container\ServiceProviders\Providers\AbstractSignatureServiceProvider;
use Nip\Container\ServiceProviders\Providers\BootableServiceProviderInterface;

/**
 * Class AuditServiceProvider
 * @package ByTIC\Audit
 */
class AuditServiceProvider extends AbstractSignatureServiceProvider implements BootableServiceProviderInterface
{
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

    public function boot()
    {
        $this->getContainer()->get('migrations.migrator')->path(dirname(__DIR__) . '/migrations/');
    }


//    protected function registerCommands()
//    {
//        $this->commands(
//            SessionsCleanup::class,
//            SubscriptionsCharge::class
//        );
//    }
}
