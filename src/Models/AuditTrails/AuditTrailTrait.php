<?php

namespace ByTIC\Audit\Models\AuditTrails;

use ByTIC\DataObjects\Behaviors\Timestampable\TimestampableTrait;
use ByTIC\DataObjects\Casts\Metadata\AsMetadataObject;

/**
 * Trait AuditTrailTrait
 * @package ByTIC\Audit\Models\AuditTrails
 *
 * @property int $model_id
 * @property string $model_type
 * @property string $event
 *
 * @property string|AsMetadataObject $metadata
 */
trait AuditTrailTrait
{
    use TimestampableTrait;

    /**
     * @var string
     */
    static protected $createTimestamps = ['created_at'];

    public function bootAuditTrailTrait()
    {
        $this->addCast('performed_at', 'datetime');
        $this->addCast('metadata', AsMetadataObject::class . ':json');
    }

    /**
     * @param $key
     * @param $value
     */
    public function addMedata($key, $value)
    {
        $this->metadata->set($key, $value);
    }

    /**
     * @param $model
     */
    public function populateFromModel($model)
    {
        $this->model_id = $model->id;
        $this->model_type = $model->getManager()->getMorphName();
    }

    /**
     * @param $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }
}