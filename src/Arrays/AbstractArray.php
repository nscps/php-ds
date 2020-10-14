<?php

namespace Nscps\Ds\Arrays;

use Traversable;

abstract class AbstractArray implements \Countable, \IteratorAggregate
{

    /**
     * @var array
     */
    protected array $arr;

    /**
     * AssocArray constructor.
     * @param array $arr
     */
    public function __construct(array $arr = [])
    {
        $this->arr = $arr;
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        return $this->arr;
    }

    /**
     * @param array $arr
     * @return AssocArray
     */
    public function setArray(array $arr): AbstractArray
    {
        $this->arr = $arr;
        return $this;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->arr);
    }

    /**
     * @return \ArrayIterator|Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->arr);
    }

}
