<?php

namespace ByTIC\Audit\Tests\Fixtures\Models\Articles;

use ByTIC\Audit\Trails\AuditTrailsRecordTrait;
use Nip\Records\Record;

/**
 * Class Article.
 */
class Article extends Record
{
    use AuditTrailsRecordTrait;

    /**
     * @return string
     */
    protected function inflectManagerName()
    {
        return Articles::class;
    }

}
