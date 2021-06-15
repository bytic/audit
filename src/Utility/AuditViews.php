<?php

namespace ByTIC\Audit\Utility;

use ByTIC\Audit\Application\Library\View\View;
use ByTIC\Audit\Trails\AuditTrailsRecordTrait;

/**
 * Class AuditViews
 * @package ByTIC\Audit\Utility
 */
class AuditViews
{

    /**
     * @param AuditTrailsRecordTrait $item
     *
     * @return null|string
     */
    public static function adminTrailsModelList($item)
    {
        $trails = $item->getAuditTrails();

        return self::loadView(
            '/admin/trails/lists/list-model',
            ['trails' => $trails]
        );
    }

    /**
     * @param $path
     * @param array $variables
     *
     * @return null|string
     */
    public static function loadView($path, $variables = [])
    {
        return View::instance()->load($path, $variables, true);
    }
}
