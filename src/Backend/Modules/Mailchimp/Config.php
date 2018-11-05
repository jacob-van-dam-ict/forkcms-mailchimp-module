<?php

namespace Backend\Modules\Mailchimp;

use Backend\Core\Engine\Base\Config as BackendBaseConfig;

/**
 * This is the configuration-object for the mailchimp module
 *
 * @author John Poelman <john.poelman@bloobz.be>
 * @author Jacob van Dam <j.vandam@jvdict.nl>
 */
class Config extends BackendBaseConfig
{
    /**
     * The default action
     *
     * @var	string
     */
    protected $defaultAction = 'Settings';

    /**
     * The disabled actions
     *
     * @var	array
     */
    protected $disabledActions = array();
}
