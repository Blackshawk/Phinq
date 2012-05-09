<?php

namespace Phinq\Query\Math\Standard;

class Multiply implements \Phinq\Query
{
	protected $numberOrCollection;
	
	public function __construct($numberOrCollection)
	{
		$this->numberOrCollection = $numberOrCollection;
	}
	
	public function execute(array $collection)
	{
		foreach($collection as $key => &$value)
		{
			if(is_array($this->numberOrCollection))
			{
				$value *= $this->numberOrCollection[$key];
			}
			else
			{
				$value *= $this->numberOrCollection;
			}
		}
			
		return $collection;
	}
}