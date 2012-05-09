<?php

namespace Phinq\Tests\Math;

use Phinq\Phinq;

class Standard extends \PHPUnit_Framework_TestCase
{
	public function testAdd()
	{
		$collection1 = array(1, 2, 3, 4);
		$collection2 = array(5, 6, 7, 8);
		
		$result 	= Phinq::_($collection1)->add($collection2)->toArray();
		$result2	= Phinq::_($collection1)->add(5)->toArray();
		
		self::assertEquals(array(6, 8, 10, 12), $result);
		self::assertEquals(array(6, 7, 8, 9), $result2);
	}
	
	public function testSubtract()
	{
		$collection1 = array(5, 6, 7, 8);
		$collection2 = array(4, 3, 2, 1);
		
		$result 	= Phinq::_($collection1)->subtract($collection2)->toArray();
		$result2	= Phinq::_($collection1)->subtract(5)->toArray();
		
		self::assertEquals(array(1, 3, 5, 7), $result);
		self::assertEquals(array(0, 1, 2, 3), $result2);
	}
	
	public function testMultiply()
	{
		$collection1 = array(5, 6, 7, 8);
		$collection2 = array(4, 3, 2, 1);
	
		$result 	= Phinq::_($collection1)->multiply($collection2)->toArray();
		$result2 	= Phinq::_($collection1)->multiply(5)->toArray();
	
		self::assertEquals(array(20, 18, 14, 8), $result);
		self::assertEquals(array(25, 30, 35, 40), $result2);
	}
	
	public function testDivide()
	{
		$collection1 = array(5, 6, 7, 8);
		$collection2 = array(4, 3, 2, 1);
	
		$result 	= Phinq::_($collection1)->divide($collection2)->toArray();
		$result2 	= Phinq::_($collection1)->divide(5)->toArray();
	
		self::assertEquals(array(1, 1.2, 1.4, 1.6), $result2);
	}
}