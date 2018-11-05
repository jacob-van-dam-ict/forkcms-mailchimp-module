<?php

namespace Frontend\Modules\Mailchimp;

use Frontend\Core\Engine\Base\Config as FrontendBaseConfig;

/**
 * This is the configuration-object
 *
 * @author John Poelman <john.poelman@bloobz.be>
 * @author Jacob van Dam <j.vandam@jvdict.nl>
 */
class Config extends FrontendBaseConfig
{
    /**
     * The default action
     *
     * @var	string
     */
    protected $defaultAction = 'Subscribe';

    /**
     * The disabled actions
     *
     * @var	array
     */
    protected $disabledActions = array();
}
