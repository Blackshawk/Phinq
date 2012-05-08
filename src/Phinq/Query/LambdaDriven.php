<?php

namespace Phinq\Query;

use Closure;
use Phinq\Query;

/**
 * 
 */
abstract class LambdaDriven implements Query, \Phinq\LambdaDriven
{
	protected $lambda;

	public function __construct(Closure $lambda)
	{
		$this->lambda = $lambda;
	}

	public final function getLambdaExpression()
	{
		return $this->lambda;
	}
}