<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/22/17
 * Time: 2:36 AM
 */

namespace Nurikabe;


class SavedTables
{
    public function __construct()
    {
        $getTable = new GetTable();

        $this->tables['3x3'] = $getTable->getTable('3x3');
        $this->tables['8x8easy'] = $getTable->getTable('8x8easy');
        $this->tables['10x10'] = $getTable->getTable('10x10');
        $this->tables['8x8med'] = $getTable->getTable('8x8med');


        /*
        $this->tables['3x3'] = new GameTable('3x3');
        $this->tables['8x8easy'] = new GameTable('8x8easy');
        $this->tables['10x10'] = new GameTable('10x10');
        $this->tables['8x8med'] = new GameTable('8x8med');
        */

    }

    public function saveTable($key, $table){
        $this->tables[$key] = $table;
    }

    public function loadTable($key){
        return $this->tables[$key];
    }

    /*
    public function makeTable($key){
        $table = new GetTable($key);
        return $table;
    }
    */

    private $tables;
}