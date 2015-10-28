<?php

namespace Frontend\Modules\Mailchimp\Ajax;

/*
* This file is part of Fork CMS.
*
* For the full copyright and license information, please view the license
* file that was distributed with this source code.
*/

use Frontend\Core\Engine\Base\AjaxAction as FrontendBaseAJAXAction;
use Frontend\Core\Engine\Model as FrontendModel;

/**
* This is the subscribe-action, it will subscribe a user to the mailinglist
*
* @author John Poelman <john.poelman@bloobz.be>
*/
class Subscription extends FrontendBaseAJAXAction
{
    /**
     * The listID
     */
    private $listID;

    /**
     * The email
     */
    private $email;

    /**
     * Execute the action
     */
    public function execute()
    {
        parent::execute();

        $this->getData();
        $this->validateForm();
        $this->makeSubscription();
    }

    /**
     * Gets the data
     */
    private function getData()
    {
        $this->email = \SpoonFilter::getPostValue('subscriber', null, '');
        $this->listID = (string) FrontendModel::getModuleSetting('Mailchimp', 'activeList');
    }

    /**
     * Makes the api call to subscribe the user
     */
    private function makeSubscription()
    {
        // get the mailchimp client
        $mailchimp = $this->getContainer()->get('zfr_mail_chimp')->getClient();

        // make the subscription
        $data = array(
            'id' => (string)$this->listID,
            'email' => array('email' => $this->email),
            'update_existing' =>  true
        );

        // make the call
        if ($mailchimp->subscribe($data)) {
            $this->output(self::OK);
        } else {
            $this->output(self::OK);
        }
    }

    /**
     * Validates the given data
     */
    private function validateForm()
    {
        // validate
        if (!\SpoonFilter::isEmail($this->email)) {
            $this->output(self::ERROR);
        }
        if ($this->email == '') {
            $this->output(self::ERROR);
        }
    }
}
