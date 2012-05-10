<?php

namespace Phinq;

use IteratorAggregate, Closure, OutOfBoundsException, BadMethodCallException, InvalidArgumentException, ArrayIterator;

abstract class PhinqBase implements \IteratorAggregate
{
	/**
	 * The original collection used to create the Phinq object. All operations are performed on this collection.
	 * @var array|Phinq|\Iterator|\IteratorAggregate
	 */
	protected $collection;
	
	/**
	 * This is a copy of the original collection, and all queries are run against this. Each query in the
	 * stack is provided with the latest version of the evaluated collection.
	 * @var array|Phinq|\Iterator|\IteratorAggregate
	 */
	protected $evaluatedCollection;
	
	/**
	 * A stack of queries to run against the collection. 
	 * @var array
	 */
	protected $queryQueue = array();
	
	/**
	 * Marks whether or not the collection still has unfinished queries to execute.
	 * @var boolean
	 */
	protected $isDirty = false;
	
	/**
	 * Construct a new instance of the Phinq object. You must call the create method
	 * statically to actually initiate this constructor.
	 * @param array|Phinq|\Iterator|\IteratorAggregate $collection The initial collection to query on
	 */
	protected function __construct($collection, array $queries = array())
	{
		$this->collection = Util::convertToNumericallyIndexedArray($collection);
		$this->evaluatedCollection = $this->collection;
	
		if(!empty($queries))
		{
			foreach($queries as $query)
			{
				$this->addToQueue($query);
			}
		}
	}
	
	/**
	 * A short method for quickly constructing the Phinq object without the need for extra typing.
	 * This method is a clone of the Phinq::create($collection) method.
	 * @see Phinq::create
	 * @param array|Phinq|Iterator|IteratorAggregate $collection The initial collection to query on.
	 * @return \Phinq\Phinq
	 */
	public static function _($collection) {
		return new static($collection);
	}
	
	/**
	 * Convenience factory method for method chaining
	 * @deprecated This method is deprecated in favor of using the Phinq::_($collection) method.
	 * @param array|Phinq|Iterator|IteratorAggregate $collection The initial collection to query on
	 * @return Phinq
	 */
	public final static function create($collection) {
		return new static($collection);
	}
	
	/**
	 * Executes any queries in the stack and with the option of running a final closure
	 * similar to a where clause before returning the collection.
	 * @param Closure $predicate
	 */
	protected function getCollection(Closure $predicate = null)
	{
		$collection = $this->toArray();
	
		if ($predicate !== null) {
			$collection = self::create($collection)->where($predicate)->toArray();
		}
	
		return $collection;
	}
	
	/**
	 * Adds a query to the Phinq query stack.
	 * @param Query $query
	 * @return void
	 */
	protected final function addToQueue(Query $query)
	{
		$this->queryQueue[] = $query;
		$this->isDirty = true;
	}
	
	/**
	 * Returns the last query in the queue.
	 * @return Ambigous <NULL, mixed>
	 */
	protected final function getLastQuery()
	{
		return empty($this->queryQueue) ? null : end($this->queryQueue);
	}
	
	/**
	 * Executes any queries in the stack and returns the collection as an array.
	 * @return array
	 */
	public function toArray()
	{
		if($this->isDirty || $this->evaluatedCollection === null)
		{
			$this->isDirty = false;
			$this->evaluatedCollection = $this->collection;
	
			foreach($this->queryQueue as $query)
			{
				/* @var $query Query */
				$this->evaluatedCollection = $query->execute($this->evaluatedCollection);
			}
		}
	
		return $this->evaluatedCollection;
	}
	
	/**
	 * Returns the collection as an ArrayAccess-able object, with the
	 * keys being chosen using the given $keySelector
	 *
	 * @param Closure $keySelector A lambda function that takes one argument, the current element, and
	 *                             returns a key for the dictionary entry for the corresponding element
	 * @return Dictionary
	 */
	public function toDictionary(Closure $keySelector)
	{
		$collection = $this->toArray();
	
		$dictionary = new Dictionary();
		for ($i = 0, $count = count($collection); $i < $count; $i++) {
			$dictionary[$keySelector($collection[$i])] = $collection[$i];
		}
	
		return $dictionary;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see IteratorAggregate::getIterator()
	 */
	public function getIterator()
	{
		return new ArrayIterator($this->toArray());
	}
}