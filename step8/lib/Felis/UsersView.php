<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/17/17
 * Time: 6:50 PM
 */

namespace Felis;


class UsersView extends View
{
    function __construct(Site $site)
    {
        $this->site = $site;
        $this->setTitle("Felis Investigations Users");
        $this->addLink("staff.php", "Staff");
        $this->addLink("post/logout.php", "Log Out");
    }


    public function presentUsers(){
        $html = '';
        $html .= <<<HTML
<form class="table" method="post" action="post/users.php">
	<p>
	<input type="submit" name="add" id="add" value="Add">
	<input type="submit" name="edit" id="edit" value="Edit">
	<input type="submit" name="delete" id="delete" value="Delete">
	</p>

	<table>
HTML;

        $html .= <<<HTML
        
		<tr>
			<th>&nbsp;</th>
			<th>Name</th>
			<th>Email</th>
			<th>Role</th>
		</tr>

		<tr>
			<td><input type="radio" name="user"></td>
			<td>Bogart, Humphrey</td>
			<td>bogart@felis.com</td>
			<td>Admin</td>
		</tr>
		<tr>
			<td><input type="radio" name="user"></td>
			<td>Spade, Sam</td>
			<td>spade@felis.com</td>
			<td>Staff</td>
		</tr>
		<tr>
			<td><input type="radio" name="user"></td>
			<td>Bacall, Lauren</td>
			<td>bacall@gmail.com</td>
			<td>Client</td>
		</tr>
	</table>
</form>
HTML;
        return $html;
    }
    private $site;
}