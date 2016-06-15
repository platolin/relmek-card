<?php
namespace Relmek;

require '../vendor/autoload.php';
$config = array('host' => '192.168.1.224','user' => 'plato', 'password'=> 'mis123','database'=> 'phpbb3',);

$dbConn = new \Simplon\Mysql\Mysql(    $config['host'],    $config['user'],    $config['password'],    $config['database']);
//讀取卡鐘資料
$lines = file("card_data.txt");

foreach($lines as $line)
{
    $card_date    =  substr($line, 0,8);
    $card_time    =  substr($line, 8,4);
    $card_mancode =  substr($line,12,4);
    $result  = $dbConn->fetchRow('SELECT userno,trdate,itrtime,otrtime FROM payin WHERE userno = :par1 and trdate = :par2', array('par1' => $card_mancode, 'par2' => $card_date) );
    $result2 = $dbConn->fetchRow('SELECT userno FROM secuser WHERE userno = :par1' , array('par1' => $card_mancode) );
    if($result & $result2 ){
        //var_dump($result);
        $conds = array('userno' => $card_mancode,'trdate' => $card_date,);
        if( $card_time < $result['itrtime']){
            $data  = array('itrtime'  => $card_time,);
            $update_result = $dbConn->update('payin', $conds, $data);
        }
        if( $card_time > $result['otrtime']){
            $data  = array('otrtime' => $card_time,);
            $update_result = $dbConn->update('payin', $conds, $data);
        }
    }else{
        if ($result2) {
            $data = array('userno' => $card_mancode,'trdate' => $card_date,    'itrtime'  => $card_time, 'otrtime' => $card_time,);
            $id = $dbConn->insert('payin', $data);
        }
    }
}
