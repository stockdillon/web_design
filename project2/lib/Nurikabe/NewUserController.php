<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/20/17
 * Time: 12:23 AM
 */

namespace Nurikabe;


class NewUserController
{
    public function __construct(Site $site, array &$session, $post)
    {
        $root = $site->getRoot();

        if(isset($post['cancel'])){
            $this->redirect = "$root/index.php";
            return;
        }


        if(!isset($post['name']) or $post['name'] == ''){
            //$this->nameErrorString = "You must enter a name!";
            $this->redirect = "$root/newuser.php?errname";
            return;
        }

        if(!isset($post['email']) or $post['email'] == ''){
            //$this->nameErrorString = "You must enter an email!!";
            $this->redirect = "$root/newuser.php?erremail";
            return;
        }



        echo "post: <br>";
        var_dump($post);

        $users = new Users($site);


        $email = strip_tags($post['email']);
        if($users->exists($email)){
            $this->redirect = "$root/newuser.php?emailtaken";
            return;
        }


        if(isset($post['name']) and isset($post['email'])) {
            $row['name'] = strip_tags($post['name']);
            $row['email'] = strip_tags($post['email']);
            $ID = 1;
            while($users->get($ID) !== null){
                $ID++;
            }
            $row['ID'] = $ID;
            var_dump($row); // remove
            $mailer = new Email();
            $users->addValidator($row['name'], $ID, $row['email'], $mailer);
            $validators = new Validators($site);
            $validators->newValidator($row['name'], $ID, $row['email']);
            $this->redirect = "$root/newuser.php?emailsent";
        }

    }


    public function getRedirect(){
        return $this->redirect;
    }

    private $redirect = '';
}
