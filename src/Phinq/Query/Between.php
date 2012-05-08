<?php

namespace Phinq\Query;

use Phinq\Query;

/**
 * A query that will return elements within a provided range of integers.
 */
class Between implements Query
{
	protected $lowerBound;
	protected $upperBound;
	
	/**
	 * 
	 * @param int $lowerBound
	 * @param int $upperBound
	 */
	public function __construct($lowerBound, $upperBound)
	{
		$this->lowerBound = $lowerBound;
		$this->upperBound = $upperBound;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Phinq.Query::execute()
	 */
	public function execute(array $collection)
	{
		return array_intersect($collection, range($this->lowerBound, $this->upperBound));
	}
}