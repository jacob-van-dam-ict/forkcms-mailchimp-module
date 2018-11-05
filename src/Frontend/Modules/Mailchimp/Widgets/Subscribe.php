<?php

namespace Frontend\Modules\Mailchimp\Widgets;

use Backend\Modules\Mailchimp\Domain\Subscribe\SubscribeType;
use Frontend\Core\Engine\Base\Widget as FrontendBaseWidget;
use Symfony\Component\Form\Form;

/**
 * This is a widget to subscribe to a mailinglist
 *
 * @author John Poelman <john.poelman@bloobz.be>
 * @author Jacob van Dam <j.vandam@jvdict.nl>
 */
class Subscribe extends FrontendBaseWidget
{
    /**
     * Execute the extra
     */
    public function execute(): void
    {
        parent::execute();

        $hasApiKey = (bool)$this->get('fork.settings')->get($this->getModule(), 'apiKey', '');

        $this->template->assign('form', $this->getForm()->createView());
        $this->template->assign('hasApiKey', $hasApiKey);

        $this->addCSS('Mailchimp.css');

        $this->loadTemplate();
    }

    private function getForm(): Form
    {
        // Load our form
        $form = $this->createForm(
            SubscribeType::class
        );

        return $form;
    }
}
