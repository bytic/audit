<?php

namespace ByTIC\Audit\Utility;

use ByTIC\Audit\Application\Library\View\View;
use ByTIC\Audit\Trails\HasAuditableTrailsRecordTrait;

/**
 * Class AuditAssets
 * @package ByTIC\Audit\Utility
 */
class AuditAssets
{
    /**
     * @param $path
     *
     * @return null|string
     */
    public static function loadAssetContent($path): ?string
    {
        $fullPath = self::basePath()
            . DIRECTORY_SEPARATOR . 'resources'
            . DIRECTORY_SEPARATOR . 'assets'
            . $path;

        if (file_exists($fullPath)) {
            return file_get_contents($fullPath);
        }

        return '';
    }

    /**
     * @return string
     */
    public static function basePath(): string
    {
        return dirname(dirname(__DIR__));
    }
}
