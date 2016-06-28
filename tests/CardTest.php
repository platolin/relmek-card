<?php
use PHPUnit\Framework\TestCase;
use Relmek\Card;
use Relmek\Payin;

class CardTest extends TestCase
{
    protected static $filename;

    public static function setUpBeforeClass()
    {
        self::$filename = __DIR__.'/card/card_data.txt';
        $myfile = fopen(self::$filename, 'w');
        $txt =  date("YmdHi"). 'S037'.chr(13).chr(10);
        fwrite($myfile, $txt);
        $txt =  date("YmdHi"). 'S001'.chr(13).chr(10);
        fwrite($myfile, $txt);
        $txt =  date("YmdHi"). 'Y001'.chr(13).chr(10);
        fwrite($myfile, $txt);
        fclose($myfile);
    }

    protected function setUp()
    {
        //
        if (!extension_loaded('mysqli')) {
            $this->markTestSkipped(
                'The MySQLi extension is not available.'
            );
        }
    }
    //
    public function testCardFileOpen()
    {
        $cardopen = new Card;
        $card_data = $cardopen->open(self::$filename);
        $this->assertCount( 3,  $card_data);
    }
    //
    public function testCardPull()
    {
        $cardtest = new Card;
        $cardtest->open(self::$filename);

        $this->assertEquals($cardtest->pull() ,  array('userno' => 'S037','trdate' => date("Ymd"), 'trtime' => Date("Hi")) );
        $this->assertEquals($cardtest->pull() ,  array('userno' => 'S001','trdate' => date("Ymd"), 'trtime' => Date("Hi")) );
        $this->assertEquals($cardtest->pull() ,  array('userno' => 'Y001','trdate' => date("Ymd"), 'trtime' => Date("Hi")) );

        $this->assertFalse($cardtest->pull());
    }
    //
    public function testPayin()
    {
        $payintest = new Payin;
        //var_dump($payintest);
        $this->assertTrue( $payintest->connectDb());
        $payin_test_key = array('userno' => 'S037','trdate' => '20160101',);
        $this->assertTrue( $payintest->delete($payin_test_key));
        $payin_test_data = array('userno' => 'S037','trdate' => '20160101',    'itrtime'  => '0800', 'otrtime' => '0800',);
        $this->assertTrue( $payintest->write($payin_test_data));
        $this->assertCount(4,$payintest->select($payin_test_key));
        $this->assertTrue( $payintest->check_userno('S037'));
        $this->assertTrue( !$payintest->check_userno('Y001'));
        $card_test_data = array('userno' => 'S037','trdate' => '20160101', 'trtime'  => '1700',);
        $this->assertTrue($payintest->update_card_data($card_test_data));
    }

    protected function tearDown()
    {

    }

    public static function tearDownAfterClass()
    {
        unlink(self::$filename);
    }
}
?>

