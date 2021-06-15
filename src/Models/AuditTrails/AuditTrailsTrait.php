<?php

namespace ByTIC\Audit\Models\AuditTrails;


use Nip\Records\EventManager\Events\Event;

/**
 * Trait AuditTrailsTrait
 * @package ByTIC\Audit\Models\AuditTrails
 */
trait AuditTrailsTrait
{
    public function bootAuditTrailsTrait()
    {
        static::creating(
            function (Event $event) {
                /** @var AuditTrailTrait|\Nip\Records\Record $record */
                $record = $event->getRecord();

                $record->setIf(
                    'metadata',
                    '{}',
                    function () use ($record) {
                        return count($record->metadata) < 1;
                    }
                );
            }
        );
    }

    protected function initRelations()
    {
        parent::initRelations();
        $this->initRelationsAuditTrails();
    }

    protected function initRelationsAuditTrails()
    {
        $this->morphTo('User', ['morphPrefix' => 'user']);
    }
}