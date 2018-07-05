<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/20/17
 * Time: 6:35 PM
 */

namespace Nurikabe;


class TableCompare
{
    public function __construct($table, $key)
    {
        $getSolvedTable = new GetSolvedTable($key);
        $solvedTable = $getSolvedTable->getSolvedTable();
        if($table == $solvedTable){
            $this->isSolved = true;
        }
    }

    public function isTableSolved(){
        return $this->isSolved;
    }

    private $isSolved;
}