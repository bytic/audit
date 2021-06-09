<?php

namespace ByTIC\Audit\Tests\Fixtures\Models\Articles;

use ByTIC\Audit\Trails\AuditTrailsRepositoryTrait;
use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class Articles.
 *
 * @method Article getNew
 */
class Articles extends RecordManager
{
    use AuditTrailsRepositoryTrait;
    use SingletonTrait;

    public function generateModelClass($class = null)
    {
        return Article::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrimaryKey()
    {
        return 'id';
    }

    /**
     * {@inheritdoc}
     */
    public function getTable()
    {
        return 'articles';
    }
}
