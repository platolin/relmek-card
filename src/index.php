<?php
/**
 * Created by PhpStorm.
 * User: relmek
 * Date: 2016/6/28
 * Time: 下午 3:14
 */
namespace Relmek;

require '../vendor/autoload.php';

use Relmek\Card;
use Relmek\Payin;

$card = new Card;
$payin = new Payin;

$card->open(__DIR__.'/../card/card-data.txt');
$count_data = 0;
do
{
    $card_data = $card->pull();

    if($card_data)
    {
        $payin->update_card_data($card_data);
        $count_data++;
    }

} while ( $card_data );


echo "total card data transform : ".$count_data ;