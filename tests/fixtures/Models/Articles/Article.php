<?php

namespace ByTIC\Audit\Tests\Fixtures\Models\Articles;

use ByTIC\Audit\Trails\AuditableModel\HasAuditTrailsRecordTrait;
use Nip\Records\Record;

/**
 * Class Article.
 */
class Article extends Record
{
    use HasAuditTrailsRecordTrait;

    /**
     * @return string
     */
    protected function inflectManagerName()
    {
        return Articles::class;
    }

}
