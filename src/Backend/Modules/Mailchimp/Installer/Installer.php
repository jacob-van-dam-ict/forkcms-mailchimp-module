<?php

namespace Backend\Modules\Mailchimp\Installer;

use Backend\Core\Installer\ModuleInstaller;
use Common\ModuleExtraType;

/**
 * Installer for the mailchimp module
 *
 * @author John Poelman <john.poelman@bloobz.be>
 * @author Jacob van Dam <j.vandam@jvdict.nl>
 */
class Installer extends ModuleInstaller
{
    /**
     * Install the module
     */
    public function install()
    {
        // add 'mailchimp' as a module
        $this->addModule('Mailchimp');

        // import locale
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        // module rights
        $this->setModuleRights(1, 'Mailchimp');

        // add extra's
        $this->insertExtra('Mailchimp',  ModuleExtraType::widget(), 'Subscribe', 'Subscribe');

        // settings
        $this->setSetting('Mailchimp', 'apiKey', '');
        $this->setSetting('Mailchimp', 'activeList', '');

        // settings navigation
        $navigationSettingsId = $this->setNavigation(null, 'Settings');
        $navigationModulesId = $this->setNavigation($navigationSettingsId, 'Modules');
        $this->setNavigation($navigationModulesId, 'Mailchimp', 'mailchimp/settings');
    }
}
