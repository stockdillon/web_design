<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/13/17
 * Time: 7:43 PM
 */

namespace Felis;


class Users extends Table {

    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "user");
    }

    /**
     * Test for a valid login.
     * @param $email User email
     * @param $password Password credential
     * @returns User object if successful, null otherwise.
     */
    public function login($email, $password) {
        $sql =<<<SQL
SELECT * from $this->tableName
where email=? and password=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($email, $password));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(\PDO::FETCH_ASSOC));
    }

    /**
     * Get a user based on the id
     * @param $id ID of the user
     * @returns User object if successful, null otherwise.
     */
    public function get($id) {
        $sql =<<<SQL
SELECT * from $this->tableName
where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(\PDO::FETCH_ASSOC));
    }



    /**
     * Modify a user record based on the contents of a User object
     * @param User $user User object for object with modified data
     * @return true if successful, false if failed or user does not exist
     */
    public function update(User $user)
    {
        $id = ($user->getId());
        if ($this->get($id) === null) {
            return false;
        } else {
            $email = strip_tags($user->getEmail());
            $name = strip_tags($user->getName());
            $phone = strip_tags($user->getPhone());
            $address = strip_tags($user->getAddress());
            $notes = strip_tags($user->getNotes());
            $role = strip_tags($user->getRole());
            $sql = <<<SQL
UPDATE $this->tableName
SET email=?, name=?, phone=?, address=?, notes=?, role=? 
WHERE id=?
SQL;
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);

            try {
                $ret = $statement->execute(array($email, $name, $phone, $address, $notes, $role, $id));
                return $ret;
            }
            catch (\PDOException $e) {
                echo $e;
                return false;
            }
            return true;
        }
    }

}