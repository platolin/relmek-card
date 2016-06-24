<?php
use PHPUnit\Framework\TestCase;
use Relmek\Card;

class CardTest extends TestCase
{
    protected $filename;

    public static function setUpBeforeClass()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }

    protected function setUp()
    {
        //
        $this->filename = __DIR__.'/card/card_data.txt';
        $myfile = fopen($this->filename, 'w');
        $txt =  date("YmdHi"). 'S037'.'\r\n';
        fwrite($myfile, $txt);
        $txt =  date("YmdHi"). 'S001'.'\r\n';
        fwrite($myfile, $txt);
        fclose($myfile);
    }
    public static function tearDownAfterClass()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }

    protected function tearDown()
    {
        unlink($this->filename);
    }
    //
    public function testCardFileOpen()
    {

        $cardopen = new Card;
        $this->assertTrue( @$cardopen->open($this->filename) );
    }



}
?>

