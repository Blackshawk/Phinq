<?php

namespace Phinq\Query;

use Phinq\Query;

class Reverse implements Query
{
	public function execute(array $collection)
	{
		return array_reverse($collection);
	}
}