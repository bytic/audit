<?php

namespace ByTIC\Audit\Trails\Events;

use ByTIC\Audit\Models\AuditTrails\AuditTrail;
use ByTIC\Audit\Trails\AuditableModel\HasAuditTrailsRecordTrait;
use Nip\Records\Record;

/**
 * Class AbstractEvent
 * @package ByTIC\Audit\Trails\Events
 */
abstract class AbstractEvent
{
    // Log types
    public const CREATE = 'CREATE'; // PUT
    public const RETRIEVE = 'RETRIEVE'; // GET
    public const UPDATE = 'UPDATE'; // POST
    public const DELETE = 'DELETE'; // DELETE
    public const ACCESS = 'ACCESS'; // View a protected/audited record
    public const ADD = 'ADD'; // Add ORM relationship (ORM::add())
    public const REMOVE = 'REMOVE'; // Remove ORM relationship (ORM::remove())
    public const UPLOAD = 'UPLOAD'; // Upload a file
    public const DOWNLOAD = 'DOWNLOAD'; // Downloaded a file
    public const EMAIL = 'EMAIL'; // Sent an email

    protected $name;

    /**
     * @var Record|HasAuditTrailsRecordTrait
     */
    protected $auditable;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return AuditTrail
     */
    public function getAuditable()
    {
        return $this->auditable;
    }

    /**
     * @param AuditTrail $auditable
     */
    public function setAuditable($auditable): void
    {
        $this->auditable = $auditable;
    }

    abstract public function getFormattedMessage() : string;
}
