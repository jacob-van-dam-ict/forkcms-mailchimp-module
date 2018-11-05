<?php

namespace Backend\Modules\Mailchimp\Domain\Settings;

use Symfony\Component\Validator\Constraints as Assert;

class SettingsDataTransferObject
{
    const STATUS_SUBSCRIBED = 'subscribed';
    const STATUS_UNSUBSCRIBED = 'unsubscribed';
    const STATUS_CLEANED = 'cleaned';
    const STATUS_PENDING = 'pending';

    /**
     * @var string
     *
     * @Assert\NotBlank(message="err.FieldIsRequired")
     */
    public $apiKey;

    /**
     * @var string
     */
    public $activeList;

    /**
     * @var string
     */
    public $status;
}
