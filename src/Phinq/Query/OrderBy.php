<?php

namespace Phinq\Query;

use Closure;

class OrderBy extends Ordered
{
	public function getSortingCallback()
	{
		$lambda = $this->getLambdaExpression();
		return \Phinq\Util::getDefaultSortCallback($lambda, $this->isDescending());
	}
}