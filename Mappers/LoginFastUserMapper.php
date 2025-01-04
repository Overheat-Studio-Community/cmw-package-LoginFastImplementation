<?php

namespace CMW\Mapper\LoginFastImplementation;

use CMW\Entity\LoginFastImplementation\LoginFastUserEntity;
use CMW\Manager\Security\EncryptManager;

class LoginFastUserMapper
{
    /**
     * @param LoginFastUserEntity $user
     * @return LoginFastUserEntity
     * @desc Classic mapping, but we decrypt the email
     */
    public static function map(LoginFastUserEntity $user): LoginFastUserEntity
    {
        return new LoginFastUserEntity(
            $user->getId(),
            EncryptManager::decrypt($user->getEmail()),
            $user->getCreatedAt()
        );
    }
}