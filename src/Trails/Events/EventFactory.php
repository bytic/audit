<?php

namespace ByTIC\Audit\Trails\Events;

use ByTIC\Audit\Models\AuditTrails\AuditTrail;
use ByTIC\Audit\Trails\AuditableModel\HasAuditTrailsRecordTrait;
use ByTIC\Audit\Trails\AuditableModel\HasAuditTrailsRepositoryTrait;
use Nip\Records\AbstractModels\Record;

/**
 * Class EventFactory
 * @package ByTIC\Audit\Trails\Events
 */
class EventFactory
{
    /**
     * @var AuditTrail
     */
    protected $trail;

    /**
     * @var HasAuditTrailsRecordTrait
     */
    protected $auditable;

    /**
     * @var HasAuditTrailsRepositoryTrait
     */
    protected $auditableManager;

    /**
     * @param AuditTrail $trail
     * @return Event
     */
    public static function for($trail): Event
    {
        return (new static($trail))->generateEvent();
    }

    /**
     * @param AuditTrail $trail
     * @return string
     */
    public static function eventClass($trail): string
    {
        $repository = $trail->getAuditableRecord()->getManager();

        if (method_exists($repository, 'getAuditTrailEventClass')) {
            return $repository->getAuditTrailEventClass($trail);
        }

        return Event::class;
    }

    /**
     * @param $trail
     */
    final protected function __construct($trail)
    {
        $this->trail = $trail;
    }

    protected function generateEvent(): Event
    {
        $class = $this->generateEventClass();
        /** @var Event $event */
        $event = new $class();

        $auditable = $this->getAuditableRecord();
        if ($auditable) {
            $event->setAuditable($auditable);
        }

        $event->setMetadata($this->trail->metadata);
        $event->setName($this->trail->getPropertyRaw('event'));
        return $event;
    }

    protected function generateEventClass(): string
    {
        $repository = $this->getAuditableRecordManager();

        if ($repository && method_exists($repository, 'getAuditTrailEventClass')) {
            return $repository->getAuditTrailEventClass($this->trail);
        }

        return Event::class;
    }

    /**
     * @return false|Record
     */
    protected function getAuditableRecord()
    {
        if (isset($this->auditable)) {
            return $this->auditable;
        }

        if ($this->trail->hasAttribute('model_type')) {
            $this->auditable = $this->trail->getAuditableRecord();
        } else {
            $this->auditable = false;
        }

        return $this->auditable;
    }

    /**
     * @return false|\Nip\Records\AbstractModels\RecordManager
     */
    protected function getAuditableRecordManager()
    {
        if (isset($this->auditableManager)) {
            return $this->auditableManager;
        }

        $auditable = $this->getAuditableRecord();
        if ($auditable instanceof Record) {
            $this->auditableManager = $auditable->getManager();
        } else {
            $this->auditableManager = false;
        }

        return $this->auditableManager;
    }
}