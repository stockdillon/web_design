<?php

require __DIR__ . "/../../vendor/autoload.php";


class ValidatorsTest extends \PHPUnit_Extensions_Database_TestCase
{

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/db/user.xml');
    }

    public function getConnection()
    {
        return $this->createDefaultDBConnection(self::$site->pdo(), 'stockdil');
    }


    public static function setUpBeforeClass() {
        self::$site = new Felis\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }


    public function test_construct() {
        $validators = new Felis\Validators(self::$site);
        $this->assertInstanceOf('Felis\Validators', $validators);
    }



    public function test_newValidator() {
        $validators = new Felis\Validators(self::$site);

        $validator = $validators->newValidator(27);
        $this->assertEquals(32, strlen($validator));

        $table = $validators->getTableName();
        $sql = <<<SQL
select * from $table
where userid=? and validator=?
SQL;

        $stmt = $validators->pdo()->prepare($sql);
        $stmt->execute(array(27, $validator));
        $this->assertEquals(1, $stmt->rowCount());
    }


    public function test_get() {
        $validators = new Felis\Validators(self::$site);

        // Test a not-found condition
        $this->assertNull($validators->get(""));

        // Create a validator
        $validator = $validators->newValidator(27);
        var_dump($validators->get($validator));
        $this->assertEquals(27, $validators->get($validator));

        // Remove the validator for this user
        $validators->remove(27);
        $this->assertNull($validators->get($validator));

        // Create two validators
        // Either can work.
        $validator1 = $validators->newValidator(33);
        $validator2 = $validators->newValidator(33);

        $this->assertEquals(33, $validators->get($validator1));
        $this->assertEquals(33, $validators->get($validator2));

        // Remove the validator for this user
        $validators->remove(33);

        $this->assertNull($validators->get($validator1));
        $this->assertNull($validators->get($validator2));
    }









    private static $site;
}

/// @endcond
