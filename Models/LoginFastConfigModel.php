<?php

namespace CMW\Model\LoginFastImplementation;

use CMW\Manager\Env\EnvManager;
use CMW\Manager\Package\AbstractModel;

/**
 * Class: @LoginFastConfigModel
 * @package LoginFastImplementation
 * @link https://craftmywebsite.fr/docs/fr/technical/creer-un-package/models
 */
class LoginFastConfigModel extends AbstractModel
{
    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return EnvManager::getInstance()->getValue('loginfast_key');
    }

    /**
     * @param string $key
     * @return void
     */
    public function updateKey(string $key): void
    {
        EnvManager::getInstance()->setOrEditValue('loginfast_key', $key);
    }
}
