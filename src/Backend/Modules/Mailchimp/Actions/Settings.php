<?php

namespace Backend\Modules\Mailchimp\Actions;

use Backend\Core\Engine\Base\ActionEdit as BackendBaseActionEdit;
use Backend\Core\Engine\Model as BackendModel;
use Backend\Modules\Mailchimp\Domain\Settings\SettingsDataTransferObject;
use Backend\Modules\Mailchimp\Domain\Settings\SettingsType;
use Mailchimp\Mailchimp;
use Symfony\Component\Form\Form;

/**
 * This is settings file for the links module
 *
 * @author John Poelman <john.poelman@bloobz.be>
 * @author Jacob van Dam <j.vandam@jvdict.nl>
 */
class Settings extends BackendBaseActionEdit
{
    /**
     * Execute the action
     */
    public function execute(): void
    {
        parent::execute();

        $form = $this->getForm();
        if (!$form->isSubmitted() || !$form->isValid()) {
            $this->template->assign('form', $form->createView());
            $this->template->assign('apiKey', $this->getSetting('apiKey', ''));

            $this->parse();
            $this->display();

            return;
        }

        $this->saveSettings($form);

        $this->redirect(
            BackendModel::createUrlForAction(
                'Settings',
                null,
                null,
                [
                    'report' => 'saved',
                ]
            )
        );
    }

    private function getForm(): Form
    {
        $data = new SettingsDataTransferObject();
        $data->apiKey = $this->getSetting('apiKey', '');
        $data->activeList = $this->getSetting('activeList', '');
        $data->status = $this->getSetting('status', SettingsDataTransferObject::STATUS_PENDING);

        $form = $this->createForm(
            SettingsType::class,
            $data,
            [
                'lists' => $this->getLists(),
            ]
        );

        $form->handleRequest($this->getRequest());

        return $form;
    }

    private function saveSettings(Form $form)
    {
        $data = $form->getData();

        $this->setSetting('apiKey', $data->apiKey);
        $this->setSetting('activeList', $data->activeList);
        $this->setSetting('status', $data->status);
    }

    /**
     * A short hand for the getter
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    private function getSetting($key, $default = null)
    {
        return $this->get('fork.settings')->get($this->url->getModule(), $key, $default);
    }

    /**
     * A short hand for the setter
     *
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    private function setSetting($key, $value)
    {
        return $this->get('fork.settings')->set($this->url->getModule(), $key, $value);
    }


    /**
     * Get the mailchimp lists
     *
     * @return array
     */
    private function getLists(): array
    {
        $apiKey = $this->getSetting('apiKey', '');
        if (!$apiKey) {
            return [];
        }

        $lists = [];
        $mailchimp = new Mailchimp($apiKey);

        foreach ($mailchimp->get('/lists')['lists'] as $list) {
            $lists[$list->name] = $list->id;
        }

        return $lists;
    }
}
