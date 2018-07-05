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
where email=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return null;
        }

        //return new User($statement->fetch(\PDO::FETCH_ASSOC));
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        // Get the encrypted password and salt from the record
        $hash = $row['password'];
        $salt = $row['salt'];

        // Ensure it is correct
        if($hash !== hash("sha256", $password . $salt)) {
            return null;
        }
        return new User($row);
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
        }
    }





    public function getClients() {
        $sql = <<<SQL
SELECT id, name
FROM $this->tableName
WHERE role="C"
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }







    public function getAgents() {
        $sql = <<<SQL
SELECT id, name
FROM $this->tableName
WHERE role="A" or role="S"
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
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
    public function add(User $user, Email $mailer) {
        // Ensure we have no duplicate email address
        // Ensure we have no duplicate email address
        if($this->exists($user->getEmail())) {
            return "Email address already exists.";
        }

        // Add a record to the user table
        // Add a record to the user table
        $sql = <<<SQL
INSERT INTO $this->tableName(email, name, phone, address, notes, joined, role)
values(?, ?, ?, ?, ?, ?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array(
            $user->getEmail(), $user->getName(), $user->getPhone(), $user->getAddress(),
            $user->getNotes(), date("Y-m-d H:i:s"), $user->getRole()));
        $id = $this->pdo()->lastInsertId();

        // Create a validator and add to the validator table
        $validators = new Validators($this->site);
        $validator = $validators->newValidator($id);

        // Send email with the validator in it
        $link = "http://webdev.cse.msu.edu"  . $this->site->getRoot() .
            '/password-validate.php?v=' . $validator;

        $from = $this->site->getEmail();
        $name = $user->getName();

        $subject = "Confirm your email";
        $message = <<<MSG
<html>
<p>Greetings, $name,</p>

<p>Welcome to Felis. In order to complete your registration,
please verify your email address by visiting the following link:</p>

<p><a href="$link">$link</a></p>
</html>
MSG;
        $headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso=8859-1\r\nFrom: $from\r\n";
        $mailer->mail($user->getEmail(), $subject, $message, $headers);
    }




    /**
     * Set the password for a user
     * @param $userid The ID for the user
     * @param $password New password to set
     */
    public function setPassword($userid, $password) {
        $salt = self::randomSalt();
        $validator = hash("sha256", $password . $salt);
        var_dump($salt);
        var_dump($validator);
        $sql= <<<SQL
UPDATE $this->tableName
SET password=?, salt=?
WHERE id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($validator, $salt, $userid));

        //$return = $statement->fetch(\PDO::FETCH_ASSOC);
        //var_dump($return);
        //return $return;
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














}