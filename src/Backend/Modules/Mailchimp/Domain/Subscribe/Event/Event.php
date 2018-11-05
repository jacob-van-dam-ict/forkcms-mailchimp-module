<?php

namespace Backend\Modules\Mailchimp\Domain\Subscribe\Event;

use Backend\Modules\Mailchimp\Domain\Subscribe\SubscribeDataTransferObject;
use Symfony\Component\EventDispatcher\Event as EventDispatcher;

abstract class Event extends EventDispatcher
{
    /** @var SubscribeDataTransferObject */
    private $data;

    public function __construct(SubscribeDataTransferObject $data)
    {
        $this->data = $data;
    }

    public function getData(): SubscribeDataTransferObject
    {
        return $this->data;
    }
}
