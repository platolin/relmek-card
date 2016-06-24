<?php

namespace Relmek;

class Card
{
    protected $content;
    
	public function open($filename)
	{
		$content = file($filename);
		if($content == false) {
			return false;
		}else{
            return true;
        }

	}
}
