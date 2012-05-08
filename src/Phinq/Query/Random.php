<?php

namespace Phinq\Query;

use Phinq\Query;

/**
 * 
 */
class Random implements Query
{
	protected $randomElementsCount;
	
	public function __construct($randomElementsCount = 1)
	{
		$this->randomElementsCount = $randomElementsCount;
	}
	
	public function execute(array $collection)
	{
		shuffle($collection);
		return array_slice($collection, 0, $this->randomElementsCount);
	}
}