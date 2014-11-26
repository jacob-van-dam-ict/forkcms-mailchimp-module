<?php

namespace Backend\Modules\Mailchimp\Installer;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Backend\Core\Installer\ModuleInstaller;

/**
 * Installer for the mailchimp module
 *
 * @author John Poelman <john.poelman@bloobz.be>
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
        $this->insertExtra('Mailchimp', 'widget', 'Subscribe', null, null, 'N', 1000);

        // settings
        $this->setSetting('Mailchimp', 'activeList', '');

        // settings navigation
        $navigationSettingsId = $this->setNavigation(null, 'Settings');
        $navigationModulesId = $this->setNavigation($navigationSettingsId, 'Modules');
        $this->setNavigation($navigationModulesId, 'Mailchimp', 'mailchimp/settings');
    }
}
