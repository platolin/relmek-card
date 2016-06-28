<?php

namespace Relmek;

class Card
{
    protected $content;
	protected $CardSize;
	protected $CardPoint = 0 ;
    
	public function open($filename)
	{
		$this->content = file($filename);

		if($this->content == false) {
			return false;
		}else{
			$this->CardSize = sizeof($this->content);
            return $this->content;
        }
	}

	public function pull()
	{
		if ($this->CardSize > $this->CardPoint){
			$card_data = $this->content[$this->CardPoint] ;
			$card_array= array(
					'trdate' =>  substr($card_data, 0,8),
					'trtime' =>  substr($card_data, 8,4),
					'userno' =>  substr($card_data,12,4),);
			$this->CardPoint ++;
			return $card_array;
		}else{
			return false;
		}
		
	}
}
