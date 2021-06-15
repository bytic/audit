<?php

namespace ByTIC\Audit\Application\Library\View;

use ByTIC\Audit\Utility\AuditAssets;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class View
 * @package ByTIC\Audit\Application\Library\View
 */
class View extends \Nip\View
{
    use SingletonTrait;

    /** @noinspection PhpMissingParentCallCommonInspection
     *
     * @return string
     */
    protected function generateBasePath(): string
    {
        return AuditAssets::basePath()
            . DIRECTORY_SEPARATOR . 'resources'
            . DIRECTORY_SEPARATOR . 'views';
    }
}
