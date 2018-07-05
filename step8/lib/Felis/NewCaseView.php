<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/16/17
 * Time: 1:13 AM
 */

namespace Felis;


class NewCaseView extends View
{
    public function __construct(Site $site)
    {
        $this->site = $site;
        $this->setTitle("Felis New Case");
        $this->addLink("staff.php", "Staff");
        $this->addLink("cases.php", "Cases");
        $this->addLink("post/logout.php", "Log Out");
    }

    public function present(){
        $html = '';
        $html .= <<<HTML
<form method="post" action="post/newcase.php">
	<fieldset>
		<legend>New Case</legend>
		<p>Client:
			<select name="client">
HTML;
        $users = new Users($this->site);
        foreach($users->getClients() as $client) {
            $id = $client['id'];
            $name = $client['name'];
            $html .= '<option value="' . $id .'"'.'>' . $name . '</option>';
        }
        $html .= <<<HTML
			</select>
		</p>

		<p>
			<label for="number">Case Number: </label>
			<input type="text" id="number" name="number" placeholder="Case Number">
		</p>

		<p><input name="ok" type="submit" value="OK"> <input name="cancel" type="submit" value="Cancel"></p>

	</fieldset>
</form>
HTML;
        return $html;
    }

    private $site;	///< The Site object
}