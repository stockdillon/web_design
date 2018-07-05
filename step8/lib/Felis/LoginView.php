<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/13/17
 * Time: 10:48 PM
 */

namespace Felis;


class LoginView extends View
{
    public function __construct($session, $get){
        if(isset($_GET['e'])){
            $this->errorMessage = '<p class="msg">Invalid login credentials</p>';
        }
    }

    public function presentForm(){
        $html = "";
        $html .= <<<HTML
<form method="post" action="post/login.php">
	<fieldset>
		<legend>Login</legend>
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email">
		</p>
		<p>
			<label for="password">Password</label><br>
			<input type="password" id="password" name="password" placeholder="Password">
			$this->errorMessage
		</p>
		<p>
			<input type="submit" value="Log in"> <a href="">Lost Password</a>
		</p>
		<p><a href="./">Felis Agency Home</a></p>
	</fieldset>
</form>
HTML;
        return $html;
    }

    private $errorMessage = '';
}