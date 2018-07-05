<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/13/17
 * Time: 8:13 PM
 */

namespace Nurikabe;



class TableRow
{


    /**
     * Constructor
     * @param $row Row from the user table in the database
     */
    public function __construct($row) {
        $this->id = $row['id'];
        $this->rownum = $row['rownum'];
        $this->key = $row['key'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRownum()
    {
        return $this->rownum;
    }

    /**
     * @param mixed $rownum
     */
    public function setRownum($rownum)
    {
        $this->rownum = $rownum;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }





    private $id;		///< The internal ID for the user
    private $rownum;		///< Email address
    private $key; 		///< Name as last, first

    const SESSION_NAME = 'table_row';

}