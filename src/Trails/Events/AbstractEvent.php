<?php

namespace ByTIC\Audit\Trails\Events;

use ByTIC\Audit\Models\AuditTrails\AuditTrail;
use ByTIC\Audit\Trails\AuditableModel\HasAuditTrailsRecordTrait;
use ByTIC\Audit\Trails\AuditTrailBuilder;
use ByTIC\DataObjects\Casts\Metadata\Metadata;
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

    protected $name = null;

    /**
     * @var Metadata
     */
    protected $metadata;

    /**
     * @var Record|HasAuditTrailsRecordTrait
     */
    protected $auditable;

    /**
     * @return Metadata
     */
    public function getMetadata(): Metadata
    {
        return $this->metadata;
    }

    /**
     * @param $key
     * @return Metadata|mixed|string|null
     */
    public function getMetadataValue($key)
    {
        return $this->metadata->get($key);
    }

    /**
     * @param Metadata $metadata
     */
    public function setMetadata(Metadata $metadata): void
    {
        $this->metadata = $metadata;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        if ($this->name === null) {
            if (defined(static::class . '::NAME')) {
                $this->name = constant(static::class . '::NAME');
            } else {
                $this->name = static::class;
            }
        }
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

    /**
     * Create an audit trail for the given auditable model using this event class.
     *
     * @param Record|HasAuditTrailsRecordTrait $auditable
     * @param array $metadata
     * @return AuditTrailBuilder
     */
    public static function addTrail($auditable, array $metadata = []): AuditTrailBuilder
    {
        $event = static::create();
        return AuditTrailBuilder::for($auditable, $event->getName())->withMetadata($metadata);
    }

    public static function create(): static
    {
        return new static();
    }

    abstract public function getFormattedMessage(): string;
}
