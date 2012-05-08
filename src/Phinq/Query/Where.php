<?php

namespace Phinq\Query;

class Where extends LambdaDriven
{
	public function execute(array $collection)
	{
		$filteredCollection = array();
		$lambda = $this->getLambdaExpression();

		array_walk($collection, function($value, $key) use (&$filteredCollection, $lambda) {
			if ($lambda($value)) {
				$filteredCollection[] = $value;
			}
		});

		return $filteredCollection;
	}
}