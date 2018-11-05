<?php

namespace Backend\Modules\Mailchimp\Domain\Subscribe\EventListener;

use Backend\Modules\Mailchimp\Domain\Settings\SettingsDataTransferObject;
use Backend\Modules\Mailchimp\Domain\Subscribe\Event\Subscribed as MailchimpSubscribed;
use Common\ModulesSettings;
use Mailchimp\Mailchimp;

final class Subscribed
{
    /**
     * @var ModulesSettings
     */
    protected $modulesSettings;

    public function __construct(ModulesSettings $modulesSettings)
    {
        $this->modulesSettings = $modulesSettings;
    }

    public function onSubscribe(MailchimpSubscribed $event): void
    {
        $apiKey = $this->modulesSettings->get('Mailchimp', 'apiKey', '');
        $listId = $this->modulesSettings->get('Mailchimp', 'activeList', '');
        $status = $this->modulesSettings->get('Mailchimp', 'status', SettingsDataTransferObject::STATUS_PENDING);

        if (!$apiKey || !$listId) {
            return;
        }

        $mailchimp = new Mailchimp($apiKey);
        try {
            $mailchimp->post(
                '/lists/' . $listId . '/members',
                [
                    'email_address' => $event->getData()->subscriber,
                    'status' => $status,
                    'merge_fields' => [
                        'FNAME' => $event->getData()->name,
                    ],
                ]
            );
        } catch (\Exception $e) {
            $message = json_decode($e->getMessage());

            if ($message->status != 400) {
                throw new \Exception($e->getMessage());
            }
        }
    }
}
