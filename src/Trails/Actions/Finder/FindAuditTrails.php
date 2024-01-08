<?php

namespace ByTIC\Audit\Trails\Actions\Finder;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\Entities\FindRecords;
use ByTIC\Audit\Utility\AuditModels;
use Nip\Records\AbstractModels\RecordManager;
use Nip\Records\Record;

/**
 *
 */
class FindAuditTrails extends Action
{
    use FindRecords;

    protected $subject;

    public static function forSubject($subject): self
    {
        $action = new static();
        $action->subject = $subject;
        return $action;
    }

    public function fetch(): \Nip\Records\Collections\Collection
    {
        if ($this->subject instanceof Record && $this->subject->hasRelation('AuditTrails')) {
            return $this->subject->getRelation('AuditTrails')->getResults();
        }
        return $this->findAll();
    }

    protected function findParams(): array
    {
        return [
            'where' => [
                ['model_id = ?', $this->subject->id],
                ['model_type = ?',   $this->subject->getManager()->getMorphName()],
            ],
        ];
    }

    protected function generateRepository(): RecordManager
    {
        return AuditModels::trails();
    }
}

