<?php

namespace Phinq\Query;

use Phinq\Query;

class Concat implements Query
{
	/**
	 * 
	 * @var array
	 */
	protected $additionalCollection = array();

	/**
	 * 
	 * @param array $additionalCollection
	 */
	public function __construct(array $additionalCollection)
	{
		$this->additionalCollection = array_values($additionalCollection);
	}

	/**
	 * (non-PHPdoc)
	 * @see Phinq.Query::execute()
	 */
	public function execute(array $collection)
	{
		return array_merge($collection, $this->additionalCollection);
	}
}