<?php
use PHPUnit\Framework\TestCase;
use Relmek\Card;

class TestCard extends TestCase
{
    public function testCardFileOpen() {

        $cardopen = new Card;
        $this->assertFalse( @$cardopen->open('/card/card_dara.txt') );
    }

    
}
?>

