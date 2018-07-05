<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/13/17
 * Time: 7:43 PM
 */

namespace Nurikabe;


class TableDatabase extends Table {

    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "table_row");
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
            echo 'id was null';
            return false;
        } else {
            $email = strip_tags($user->getEmail());
            $name = strip_tags($user->getName());
            $sql = <<<SQL
UPDATE $this->tableName
SET email=?, name=?
WHERE id=?
SQL;
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);

            try {
                $ret = $statement->execute(array($email, $name,  $id));
                echo 'update success';
                return $ret;
            }
            catch (\PDOException $e) {
                echo 'update failed';
                return false;
            }
        }
    }



    /**
     * Determine if a user exists in the system.
     * @param $email An email address.
     * @returns true if $email is an existing email address
     */
    public function exists($email) {
        $sql =<<<SQL
SELECT * from $this->tableName
where email=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return false;
        }

        //return User($statement->fetch(\PDO::FETCH_ASSOC));
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        if($row === null){
            return false;
        }
        return true;
    }






    /**
     * Create a new user.
     * @param User $user The new user data
     * @param Email $mailer An Email object to use
     * @return null on success or error message if failure
     */
    public function add(TableRow $tableRow){
        // Add a record to the user table

        $id = strip_tags($tableRow->getId());
        $key = strip_tags($tableRow->getKey());
        $rownum = strip_tags($tableRow->getRownum());
        var_dump($this->tableName);
        var_dump($id);
        var_dump($key);
        var_dump($rownum);

        $sql = <<<SQL
INSERT INTO $this->tableName(id, tablekey, rownum)
values(?, ?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($id, $key, $rownum));
        //$id = $this->pdo()->lastInsertId();

        $return = $statement->fetch(\PDO::FETCH_ASSOC);
        var_dump($return);
        return $return;
    }

}