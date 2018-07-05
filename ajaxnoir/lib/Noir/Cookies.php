<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/27/17
 * Time: 8:00 PM
 */

namespace Noir;


class Cookies extends Table
{
    public function __construct(Site $site, The $name = null)
    {
        parent::__construct($site, 'cookie');
    }

    /**
     * Create a new cookie token
     * @param $user User to create token for
     * @return New 32 character random string
     */
    public function create($user) {
        $token = $this->randomSalt(32);
        $salt = $this->randomSalt(16);
        $hash = hash("sha256", $token . $salt);
        $date = \DateTime::COOKIE;

        //var_dump("before sql");
        $sql = <<<SQL
INSERT INTO $this->tableName(user, salt, hash, date)
VALUES (?, ?, ?, ?)
SQL;
/*
        $sql = <<<SQL
UPDATE $this->tableName
SET user=?, date=?
WHERE user=?
SQL;
*/
        //var_dump("after sql");


        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($user, $salt, $hash, "now()"));

        //$res = ($statement->fetch(\PDO::FETCH_ASSOC));

        return $token;
    }


    /**
     * Generate a random salt string of characters for password salting
     * @param $len Length to generate, default is 16
     * @returns Salt string
     */
    public static function randomSalt($len = 16) {
        $bytes = openssl_random_pseudo_bytes($len / 2);
        return bin2hex($bytes);
    }


    /**
     * Validate a cookie token
     * @param $user User ID
     * @param $token Token
     * @return null|string If successful, return the actual
     *   hash as stored in the database.
     */
    public function validate($user, $token){
        $sql = <<<SQL
SELECT hash, salt
FROM $this->tableName
where user=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($user));

        $res = ($statement->fetchall(\PDO::FETCH_ASSOC));
        //var_dump($res);

        for($i=0; $i<count($res); $i++){
            $hash = $res[$i]['hash'];
            $salt = $res[$i]['salt'];
            if($hash == hash("sha256", $token . $salt)) {
                return $hash;
            }
        }
        return null;
    }

    /**
     * Delete a hash from the database
     * @param $hash Hash to delete
     * @return bool True if successful
     */
    public function delete($hash) {
        $sql = <<<SQL
DELETE FROM $this->tableName
WHERE hash=?
SQL;

        //var_dump("after delete sql");

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $res = $statement->execute(array($hash));
        return $res;
    }
}