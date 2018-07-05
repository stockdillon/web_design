<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/16/17
 * Time: 12:29 AM
 */

namespace Felis;


class CasesController
{
    public function __construct(Site $site, array $post)
    {
        $root = $site->getRoot();
        if(isset($post['add'])){
            $this->redirect = "$root/newcase.php";
        }

        else{$this->redirect = "$root/cases.php";}
    }

    public function getRedirect(){
        return $this->redirect;
    }

    private $redirect;	///< Page we will redirect the user to.
}