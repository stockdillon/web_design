<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/17/17
 * Time: 8:41 PM
 */

namespace Felis;


class PasswordValidateView extends View
{
    public function __construct(Site $site, $get)
    {
        $this->setTitle("Felis Password Entry");
        $this->validator = strip_tags($get['v']);
    }

    public function presentPasswordValidate(){
        $html = '';
        $html .= <<<HTML
<form method="post" action="post/password-validate.php">
		<input type="hidden" name="validator" value="$this->validator">
	<fieldset>
		<legend>Change Password</legend>
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
			<label for="passwordAgain">Password (again)</label><br>
			<input type="password" id="password2" name="password2" placeholder="Password">
			$this->errorMessage
		</p>
		<p>
			<input type="submit" value="OK" name="ok">
		</p>
		<p>
			<input type="submit" value="Cancel" name="cancel">
		</p>
	</fieldset>
</form>
HTML;
        return $html;
    }

    private $errorMessage = "";
    private $validator;
}