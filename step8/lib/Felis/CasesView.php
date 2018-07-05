<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/15/17
 * Time: 11:49 PM
 */

namespace Felis;


class CasesView extends View
{
    public function __construct(Site $site)
    {
        $this->site = $site;
        $this->setTitle("Felis Investigations Cases");
        $this->addLink("staff.php", "Staff");
        $this->addLink("post/logout.php", "Log Out");
    }

    public function presentCases(){
        $html = '';
        $html .= <<<HTML
<form class="table" method="post" action="post/cases.php">
	<p>
	<input type="submit" name="add" id="add" value="Add">
	<input type="submit" name="delete" id="delete" value="Delete">
	</p>
	<table>
HTML;
        $cases = new Cases($this->site);
        $all = $cases->getCases();
        foreach($all as $case) {
            $id = $case->getId();
            $num = $case->getNumber();
            $client = $case->getClientName();
            $agent = $case->getAgentName();
            $summary = $case->getSummary();
            $open = $case->getStatus() === ClientCase::STATUS_OPEN ?
                "Open" : "Closed";

            $html .= <<<HTML
		<tr>
			<td><input type="radio" name="user" value="$id"></td>
			<td><a href="case.php?id=$id">$num</a></td>
			<td>$client</td>
			<td>$agent</td>
			<td class="desc"><div>$summary</div></td>
			<td></td>
			<td>$open</td>
		</tr>
HTML;
        }

    $html .= <<<HTML
		</tr>
	</table>
</form>
HTML;
        return $html;
    }

    private $site;
}