<?php

namespace CMW\Model\LoginFastImplementation;

use CMW\Entity\LoginFastImplementation\LoginFastUserEntity;
use CMW\Manager\Database\DatabaseManager;
use CMW\Manager\Package\AbstractModel;
use ReflectionException;

/**
 * Class: @LoginFastUserModel
 * @package LoginFastImplementation
 * @link https://craftmywebsite.fr/docs/fr/technical/creer-un-package/models
 */
class LoginFastUserModel extends AbstractModel
{
    /**
     * @param string $mail
     * @return LoginFastUserEntity|null
     */
    public function store(string $mail): ?LoginFastUserEntity
    {
        $sql = "INSERT INTO lf_user (email) VALUES (:mail);";
        $db = DatabaseManager::getInstance();
        $db->prepare($sql);
        $req = $db->prepare($sql);

        if (!$req->execute(['mail' => $mail])) {
            return null;
        }

        return $this->get($db->lastInsertId());
    }

    /**
     * @param int $id
     * @return LoginFastUserEntity|null
     */
    public function get(int $id): ?LoginFastUserEntity
    {
        $sql = "SELECT * FROM lf_user WHERE id = :id;";
        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);

        if (!$req->execute(['id' => $id])) {
            return null;
        }

        $res = $req->fetch();

        if (!$res) {
            return null;
        }

        try {
            return LoginFastUserEntity::toEntity($res);
        } catch (ReflectionException $_) {
            return null;
        }
    }

    /**
     * @param string $mail
     * @return LoginFastUserEntity|null
     */
    public function getByMail(string $mail): ?LoginFastUserEntity
    {
        $sql = "SELECT * FROM lf_user WHERE email = :mail;";
        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);

        if (!$req->execute(['mail' => $mail])) {
            return null;
        }

        $res = $req->fetch();

        if (!$res) {
            return null;
        }

        try {
            return LoginFastUserEntity::toEntity($res);
        } catch (ReflectionException $_) {
            return null;
        }
    }

    /**
     * @return LoginFastUserEntity[]
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM lf_user;";
        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);

        if (!$req->execute()) {
            return [];
        }

        $res = $req->fetchAll();

        if (!$res) {
            return [];
        }

        try {
            return LoginFastUserEntity::toEntityList($res);
        } catch (ReflectionException $_) {
            return [];
        }
    }

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $sql = "DELETE FROM lf_user WHERE id = :id;";
        $db = DatabaseManager::getInstance();
        return $db->prepare($sql)->execute(['id' => $id]);
    }
}
