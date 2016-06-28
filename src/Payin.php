<?php
/**
 * Created by PhpStorm.
 * User: plato
 * Date: 2016/6/27
 * Time: 下午 3:50
 */

namespace Relmek;

use Simplon\Mysql\Mysql;

class Payin 
{
    protected $dbConn;

    public function __construct()
    {
        $config = array('host' => '192.168.1.221',
                        'user' => 'plato',
                        'password'=> 'mis123',
                        'database'=> 'phpbb3',);

        $this->dbConn = new Mysql(  $config['host'],
                                    $config['user'],
                                    $config['password'],
                                    $config['database']);
    }

    public function select(array $card_key)
    {
        $result  = $this->dbConn->fetchRow('SELECT userno,trdate,itrtime,otrtime FROM payin WHERE userno = :par1 and trdate = :par2',
                                            array('par1' => $card_key['userno'], 'par2' => $card_key['trdate'] ) );
        if ($result){
            return $result;
        }else{
            return false;
        }
    }
    public function check_userno($userno)
    {
        $result  = $this->dbConn->fetchRow('SELECT userno FROM secuser WHERE userno = :par1 ',
                                            array('par1' => $userno,  ) );
        if ($result){
            return true;
        }else{
            return false;
        }
    }
    public function update_card_data(array $card_data)
    {
        $payin_data = $this->select($card_data);
        if($payin_data){
            $conds = array('userno' => $card_data['userno'],'trdate' => $card_data['trdate'],);
            if( $card_data['trtime'] < $payin_data['itrtime']){
                $data  = array('itrtime'  => $card_data['trtime'],);
                $this->dbConn->update('payin', $conds, $data);
            }
            if( $card_data['trtime'] > $payin_data['otrtime']){
                $data  = array('otrtime' => $card_data['trtime'],);
                $this->dbConn->update('payin', $conds, $data);
            }
        }else{
            $payin_data = array('userno'  => $card_data['userno'],
                                'trdate'  => $card_data['trdate'],
                                'itrtime' => $card_data['trtime'],
                                'otrtime' => $card_data['trtime'],);
            $this->write($payin_data);
        }
        return true;
    }
    public function delete(array $payin_key)
    {
        if($this->dbConn->delete('payin', $payin_key) > 0 ){
            return true;
        }else{
            return false;
        }
    }
    public function write(array $payin_data)
    {
        if($this->dbConn->insert('payin', $payin_data) > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function connectDb()
    {
        return true;
    }

}