<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/20/17
 * Time: 12:23 AM
 */

namespace Nurikabe;


class ValidateController
{
        public function __construct(Site $site, array &$session, array $post)
        {

            var_dump($post);
            $root = $site->getRoot();

            if(isset($post['cancel'])){
                $this->redirect = "$root/index.php";
                return;
            }

            $vstring = '';
            $v = '';
            if(isset($post['v'])){
                $vstring = "v=".$post['v'];
                $v = $post['v'];
            }

            if(!isset($post['email']) or $post['email'] == '' or $post['email'] === null){
                $this->redirect = "$root/password-validate.php?erremail?$vstring";
                return;
            }

            if(!isset($post['password']) or $post['password'] == '' or $post['password'] === null){
                $this->redirect = "$root/password-validate?errpassword?$vstring";
                return;
            }

            if(!isset($post['again']) or $post['again'] == '' or $post['again'] === null){
                $this->redirect = "$root/password-validate?errpassword?$vstring";
                return;
            }

            if($post['password'] != $post['again']){
                $this->redirect = "$root/password-validate.php?nomatch?$vstring";
                return;
            }

            if(!isset($post['v']) or $post['v'] == ''){
                $this->redirect = "$root/password-validate.php?errvalidator";
                return;
            }



            $validators = new Validators($site);
            $email = strip_tags($post['email']);
            $password = strip_tags($post['password']);
            $id = $validators->get($v);
            if($id === null){
                $this->redirect = "$root/password-validate.php?errvalidator";
                return;
            }
            $name = $validators->getName($id);

            $row['email'] = $email;
            $row['id'] = $id;
            $row['name'] = $name;
            var_dump($row);

            $user = new User($row);
            var_dump($user);

            $users = new Users($site);
            $users->add($user);
            var_dump($users);

            $users->setPassword($id, $password);


            //$user = $users->login($email, $password);
            //$session[User::SESSION_NAME] = $user;
            //var_dump($session);

            $this->redirect = "$root/index.php";
        }


        public function getRedirect(){
            return $this->redirect;
        }

        private $redirect = '';
        private $user;
}
