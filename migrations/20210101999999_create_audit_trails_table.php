<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

/**
 * Class OrgReportsFileStatus
 */
final class CreateAuditTrailsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table_name = \ByTIC\Audit\Utility\AuditModels::trails()->getTable();
        $exists = $this->hasTable($table_name);
        if ($exists) {
            return;
        }

        $this->table($table_name)
            ->addColumn('model_id', 'biginteger')
            ->addColumn('model_type', 'string')
            ->addColumn('event', 'string')
            ->addColumn('metadata', 'json', ['null' => true])
            ->addColumn('user_id', 'biginteger', ['null' => true])
            ->addColumn('user_type', 'string', ['null' => true])
            ->addColumn('user_ip', 'string', ['null' => true])
            ->addColumn('user_agent', 'string', ['null' => true])
            ->addColumn('performed_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->addIndex(['model_id', 'model_type'])
            ->addIndex(['event'])
            ->addIndex(['user_id', 'user_type'])
            ->addIndex(['performed_at'])
            ->addIndex(['created_at'])
            ->save();
    }
}
