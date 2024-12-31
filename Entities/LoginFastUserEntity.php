<?php

namespace CMW\Entity\LoginFastImplementation;

use CMW\Manager\Package\AbstractEntity;

/**
 * Class: @LoginFastUserEntity
 * @package LoginFastImplementation
 * @link https://craftmywebsite.fr/docs/fr/technical/creer-un-package/entities
 */
class LoginFastUserEntity extends AbstractEntity
{
    private int $id;
    private string $email;
    private string $createdAt;

    /**
     * @param int $id
     * @param string $email
     * @param string $createdAt
     */
    public function __construct(int $id, string $email, string $createdAt)
    {
        $this->id = $id;
        $this->email = $email;
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
