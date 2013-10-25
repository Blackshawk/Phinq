<?php

namespace Phinq\Query;

class SelectMany extends LambdaDriven
{
	public function execute(array $collection)
	{
		$flattenedCollection = array();
		$lambda = $this->getLambdaExpression();

		array_walk($collection, function($value, $key) use (&$flattenedCollection, $lambda) {
			$flattenedCollection = array_merge($flattenedCollection, array_values($lambda($value)));
		});

		return $flattenedCollection;
	}
}
