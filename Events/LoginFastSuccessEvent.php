<?php

namespace CMW\Event\LoginFastImplementation;

use CMW\Manager\Events\AbstractEvent;

/**
 * Class: @LoginFastSuccessEvent
 * @package LoginFastImplementation
 * @link https://craftmywebsite.fr/docs/fr/technical/creer-un-package/events
 */
class LoginFastSuccessEvent extends AbstractEvent
{
    public function getName(): string
    {
        return 'LoginFastSuccessEvent-LoginFastImplementation-CraftMyWebsite';
    }
}
