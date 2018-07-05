<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/20/17
 * Time: 12:23 AM
 */

namespace Nurikabe;


class LoginController
{
        public function __construct(Site $site, array &$session, array $post)
        {
            $root = $site->getRoot();

            if(isset($post['cancel'])){
                $this->redirect = "$root/index.php";
                return;
            }


            if(!isset($post['email']) or $post['email']=='' or $post['email'] === null){
                $this->redirect = "$root/login.php?erremail";
                return;
            }

            if(!isset($post['password']) or $post['password']=='' or $post['password'] === null){
                $this->redirect = "$root/login.php?errpassword";
                return;
            }



            $users = new Users($site);

            $email = strip_tags($post['email']);
            $password = strip_tags($post['password']);
            $user = $users->login($email, $password);
            if($user === null){
                $this->redirect = "$root/login.php?errcredentials";
                return;
            }
            //var_dump($user);
            $session[User::SESSION_NAME] = $user;
            //$this->redirect = "$root/index.php?loginsuccess";
            $this->redirect = "$root/index.php";
        }


        public function getRedirect(){
            return $this->redirect;
        }

        private $redirect = '';
}
