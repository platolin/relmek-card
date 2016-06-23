<?php

namespace Relmek;

class Card 
{

	protected $content;

	public function open($filename)
	{
		$content = fopen($filename, 'r');
		if($content == false) {
			return false;
		}

	}
}
