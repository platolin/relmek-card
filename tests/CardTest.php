<?php
use PHPUnit\Framework\TestCase;
use Relmek\Card;

class CardTest extends TestCase
{
    public function testCardFileOpen() {

        $cardopen = new Card;
        //
        $filename = __DIR__.'/card/card_data.txt';
        $myfile = fopen($filename, 'w');
        $txt =  date("YmdHi"). 'S037'.'\r\n';
        fwrite($myfile, $txt);
        $txt =  date("YmdHi"). 'S001'.'\r\n';
        fwrite($myfile, $txt);
        fclose($myfile);

        $this->assertTrue( @$cardopen->open($filename) );
    }



}
?>

