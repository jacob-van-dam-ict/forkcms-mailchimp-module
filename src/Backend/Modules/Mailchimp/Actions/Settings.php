<?php

namespace Backend\Modules\Mailchimp\Actions;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

 use Backend\Core\Engine\Base\ActionEdit as BackendBaseActionEdit;
 use Backend\Core\Engine\Authentication as BackendAuthentication;
 use Backend\Core\Engine\Model as BackendModel;
 use Backend\Core\Engine\Form as BackendForm;

/**
 * This is settings file for the links module
 *
 * @author John Poelman <john.poelman@bloobz.be>
 */
class Settings extends BackendBaseActionEdit
{
	/**
	 * Settings
	 *
	 * @var	array
	 */
	private $settings = array();
	
	/**
	 * Execute the action
	 */
	public function execute()
	{
		parent::execute();
		$this->loadForm();
		$this->validateForm();
		$this->parse();
		$this->display();
	}

	/**
	 * load the form
	 */
	private function loadForm()
	{
		// check if user is almighty
		$this->isGod = BackendAuthentication::getUser()->isGod();
		
		// create form instance
		$this->frm = new BackendForm('settings');
		
		// fetch module settings
		$this->settings = BackendModel::getModuleSettings('Mailchimp');

        // connect to mailchimp and get the lists
        $mailchimp = $this->getContainer()->get('zfr_mail_chimp')->getClient();
        $lists = $mailchimp->getLists();

        // loop the lists and add to key value array
        $listItems = array();

        if($lists['total'] > 0) {
            foreach ($lists['data'] as $l)
            {
                $listItems[$l['id']] = $l['name'];
            }
        }

		// add the formfields
		$this->frm->addDropdown('list', $listItems, $this->settings['activeList']);
	}

	/**
	 * Parse the form
	 */
	protected function parse()
	{
		parent::parse();
	}

	/**
	 * Validate the form
	 */
	private function validateForm()
	{
		if($this->frm->isSubmitted())
		{
			if($this->frm->isCorrect())
			{
				// get the settings
				$settings = array();
				$settings['activeList'] = $this->frm->getField('list')->getValue();
				
				// save the new settings
				BackendModel::setModuleSetting($this->getModule(), 'activeList', $settings['activeList']);
				
				// trigger event
				BackendModel::triggerEvent($this->getModule(), 'after_saved_settings');

				// redirect to the settings page
				$this->redirect(BackendModel::createURLForAction('settings') . '&report=saved');
			}
		}
	}
}