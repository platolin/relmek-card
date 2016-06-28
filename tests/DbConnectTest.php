<?php

/**
 * Created by PhpStorm.
 * User: relmek
 * Date: 2016/6/27
 * Time: 上午 10:02
 */
class DbConnectTest extends PHPUnit_Framework_TestCase
{
    protected static $dbh;

    public static function setUpBeforeClass()
    {
        self::$dbh = new PDO('sqlite::memory:');
    }

    public static function tearDownAfterClass()
    {
        self::$dbh = null;
    }

    public function setUp()
    {
        if (!extension_loaded('mysqli')) {
            $this->markTestSkipped(
                'The mysqli extension is not available.'
            );
        }
    }

    public function testFailure()
    {
        $this->assertEquals(1, 1);
    }
}
