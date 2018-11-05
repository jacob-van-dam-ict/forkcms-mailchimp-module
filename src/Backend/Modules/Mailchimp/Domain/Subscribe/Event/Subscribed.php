<?php

namespace Backend\Modules\Mailchimp\Domain\Subscribe\Event;

final class Subscribed extends Event
{
    /**
     * @var string The name the listener needs to listen to to catch this event.
     */
    const EVENT_NAME = 'mailchimp.event.subscribe.subcribed';
}
