<?php

namespace Phinq\Query;

class TakeWhile extends LambdaDriven
{
	public function execute(array $collection)
	{
		$sliceIndex = -1;
		$predicate = $this->getLambdaExpression();
		
		while (array_key_exists(++$sliceIndex, $collection) && $predicate($collection[$sliceIndex]));

		return array_slice($collection, 0, $sliceIndex);
	}
}