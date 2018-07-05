<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/17/17
 * Time: 1:07 PM
 */

namespace Felis;


class CaseController
{
    public function __construct(Site $site, User $user, array $post)
    {
        $root = $site->getRoot();
        if(!isset($post['update'])) {
            $this->redirect = "$root/cases.php";
            return;
        }

        $this->id = $post['id'];
        $number = $post['number'];
        $cases = new Cases($site);
        $all = $cases->getCases();
        foreach($all as $case){
            $case_number = $case->getNumber();
            if($number == $case_number and $this->id !== $case->getId()){
                $this->redirect = "$root/case.php?id=$this->id";
                return;
            }
        }

        if(isset($post['update'])){
            $row['id'] = $post['id'];
            $row['number'] = $post['number'];
            $row['summary'] = $post['summary'];
            $row['agent'] = $post['agent'];
            $row['status'] = $post['status'];

            $cases = new Cases($site);
            $old_case = $cases->get($this->id);
            $row['clientName'] = $old_case->getClientName();
            $row['agentName'] = $old_case->getAgentName();
            $row['client'] = $old_case->getClient();

            /*
            $clientID = $case->getClient();
            $clientName = $case->getClientName();
            $agentID = $case->getAgent();
            $agentName = $case->getAgentName();
            $number = $case->getNumber();
            $summary = $case->getSummary();
            $status = $case->getStatus();
            */

            echo "row in controller: ";
            var_dump($row);
            $case = new ClientCase($row);
            echo "case in controller: ";
            var_dump($case);
            $cases->update($case);
            return;
        }

        $this->redirect = "$root/cases.php";
    }

    public function getRedirect(){
        return $this->redirect;
    }

    private $redirect;	///< Page we will redirect the user to.
    private $id;
}