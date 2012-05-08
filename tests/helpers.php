<?php

namespace Phinq\Tests;


class IdComparer implements \Phinq\EqualityComparer
{
	public function equals($a, $b)
	{
		return $a->id === $b->id ? 0 : ($a->id < $b->id ? -1 : 1);
	}
}

class Sphinqter
{
	public $id;
	public $foo;

	public function __construct($id = null, $foo = null) {
		$this->id = $id;
		$this->foo = $foo;
	}
}
