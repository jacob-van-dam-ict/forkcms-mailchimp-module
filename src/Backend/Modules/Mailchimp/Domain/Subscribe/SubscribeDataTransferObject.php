<?php

namespace Backend\Modules\Mailchimp\Domain\Subscribe;

use Symfony\Component\Validator\Constraints as Assert;

class SubscribeDataTransferObject
{
    /**
     * @var string
     *
     * @Assert\NotBlank(message="err.FieldIsRequired")
     */
    public $name;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="err.FieldIsRequired")
     * @Assert\Email(
     *     message = "err.EmailIsRequired",
     *     checkMX = true
     * )
     */
    public $subscriber;
}
