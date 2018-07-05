<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/17/17
 * Time: 7:23 PM
 */

namespace Felis;


class Validators extends Table
{
    public function __construct(Site $site, $name="validator")
    {
        parent::__construct($site, $name);
    }


    /**
     * Create a new validator and add it to the table.
     * @param $userid User this validator is for.
     * @return The new validator.
     */
    public function newValidator($userid) {
        $validator = $this->createValidator();

        // Write to the table
        $sql = <<<SQL
insert into $this->tableName(userid, validator)
values(?, ?)
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            if($statement->execute(array($userid, $validator)
                ) === false) {
                return null;
            }
        } catch(\PDOException $e) {
            return null;
        }

        return $validator;
    }

    /**
     * Generate a random validator string of characters
     * @param $len Length to generate, default is 32
     * @returns Validator string
     */
    public function createValidator($len = 32) {
        $bytes = openssl_random_pseudo_bytes($len / 2);
        return bin2hex($bytes);
    }



    /**
     * Determine if a validator is valid. If it is,
     * return the user ID for that validator.
     * @param $validator Validator to look up
     * @return User ID or null if not found.
     */
    public function get($validator) {
        echo "table name: ";
        var_dump($this->tableName);
        $sql = <<<SQL
SELECT userid
FROM $this->tableName
WHERE validator=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            $statement->execute(array($validator));
        }
        catch (\PDOException $e) {
            return null;
        }

        $return = $statement->fetch(\PDO::FETCH_ASSOC);
        if($statement->rowCount() === 0) {
            return null;
        }
        if($return === null){
            return null;
        }
        echo "returning , return...";
        return $return['userid'];
    }

    /**
     * Remove any validators for this user ID.
     * @param $userid The USER ID we are clearing validators for.
     */
    public function remove($userid) {
        $sql = <<<SQL
DELETE FROM $this->tableName
WHERE userid=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($userid));
        //$statement->fetch(\PDO::FETCH_ASSOC);
    }

















}