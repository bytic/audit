<?php

namespace ByTIC\Audit\Models\AuditTrails;

use ByTIC\Audit\Trails\Events\EventFactory;
use ByTIC\DataObjects\Behaviors\Timestampable\TimestampableTrait;
use ByTIC\DataObjects\Casts\Metadata\AsMetadataObject;
use Carbon\Carbon;
use Nip\Records\AbstractModels\Record;

/**
 * Trait AuditTrailTrait
 * @package ByTIC\Audit\Models\AuditTrails
 *
 * @property int $model_id
 * @property string $model_type
 * @property string $event
 *
 * @property string $user_id
 * @property string $user_type
 * @property string $user_ip
 * @property string $user_agent
 *
 * @property string|\DateTime|Carbon $performed_at
 * @property string|\DateTime|Carbon $created_at
 *
 * @property string|AsMetadataObject $metadata
 *
 * @method Record getUser()
 * @method Record getAuditableRecord()
 */
trait AuditTrailTrait
{
    use TimestampableTrait;

    protected $event = null;

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
     * @return \ByTIC\Audit\Trails\Events\Event|string
     */
    public function getEvent()
    {
        if ($this->event === null) {
            $this->event = EventFactory::for($this);
        }
        return $this->event;
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
     * @param?Record $user
     */
    public function populateFromUser($user)
    {
        if ($user instanceof Record) {
            $this->user_id = $user->id;
            $this->user_type = $user->getManager()->getMorphName();
            return;
        }
        $this->user_id = 0;
        $this->user_type = null;
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