<?php

namespace Phinq\Query;

use Phinq\Comparer;
use Phinq\DefaultEqualityComparer;
use Phinq\EqualityComparer;
use Phinq\Query;

/**
 * 
 */
abstract class Comparable implements Query, Comparer
{
	/**
	 * 
	 * @var EqualityComparer
	 */
	protected $comparer;

	/**
	 * Construct a new instance of this object.
	 * @param EqualityComparer $comparer
	 */
	public function __construct(EqualityComparer $comparer = null)
	{
		$this->comparer = $comparer ?: DefaultEqualityComparer::getInstance();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Phinq.Comparer::getComparer()
	 */
	public final function getComparer()
	{
		return $this->comparer;
	}
}