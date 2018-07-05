<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/17/17
 * Time: 6:50 PM
 */

namespace Felis;


class UserView extends View{
    function __construct(Site $site)
    {
        $this->site = $site;
        $this->setTitle("Felis Investigations User");
        $this->addLink("staff.php", "Staff");
        $this->addLink("users.php", "Users");
        $this->addLink("post/logout.php", "Log Out");
    }

    public function presentUser(){
        $html = '';
        $html .= <<<HTML
<form action="post/user.php" method="post">
	<fieldset>
		<legend>User</legend>
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email">
		</p>
		<p>
			<label for="name">Name</label><br>
			<input type="text" id="name" name="name" placeholder="Name">
		</p>
		<p>
			<label for="phone">Phone</label><br>
			<input type="text" id="phone" name="phone" placeholder="Phone">
		</p>
		<p>
			<label for="address">Address</label><br>
			<textarea id="address" name="address" placeholder="Address"></textarea>
		</p>
		<p>
			<label for="notes">Notes</label><br>
			<textarea id="notes" name="notes" placeholder="Notes"></textarea>
		</p>
		<p>
			<label for="role">Role: </label>
			<select id="role" name="role">
				<option value="admin">Admin</option>
				<option value="staff">Staff</option>
				<option value="client">Client</option>
			</select>
		</p>
		<p>
			<input type="submit" value="OK"> <input type="submit" value="Cancel" name="cancel">
		</p>

	</fieldset>
</form>

	<p>
		Admin users have complete management of the system. Staff users are able to view and make
		reports for any client, but cannot edit the users. Clients can only view the cases
		they have contracted for.
	</p>
HTML;
        return $html;
}


}