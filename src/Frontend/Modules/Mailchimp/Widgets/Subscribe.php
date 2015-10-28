<?php

namespace Frontend\Modules\Mailchimp\Widgets;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Frontend\Core\Engine\Base\Widget as FrontendBaseWidget;
use Frontend\Core\Engine\Form as FrontendForm;

/**
 * This is a widget to subscribe to a mailinglist
 *
 * @author John Poelman <john.poelman@bloobz.be>
 */
class Subscribe extends FrontendBaseWidget
{
    /**
     * Execute the extra
     */
    public function execute()
    {
        parent::execute();
        $this->loadTemplate();
        $this->loadForm();
        $this->parse();
    }

    /**
     * Load the form
     */
    private function loadForm()
    {
        $this->frm = new FrontendForm('subscribe');
        $this->frm->addText('subscriber')->setAttributes(array('required' => null));
    }

    /**
     * Parse
     */
    private function parse()
    {
        $this->frm->parse($this->tpl);
        $this->header->addCSS('/src/Frontend/Modules/Mailchimp/Layout/Css/Mailchimp.css');
    }
}
