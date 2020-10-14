<?php

namespace Nscps\Ds\Arrays;

use Traversable;

class AssocArray implements \Countable, \IteratorAggregate
{

    /**
     * @var array
     */
    private array $arr;

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
    public function getData(): array
    {
        return $this->arr;
    }

    /**
     * @param array $arr
     * @return AssocArray
     */
    public function setData(array $arr): AssocArray
    {
        $this->arr = $arr;
        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->arr);
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed|null
     */
    public function get(string $key, $default = null)
    {
        return $this->has($key) ? $this->arr[$key] : $default;
    }

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    public function set(string $key, $value): AssocArray
    {
        $this->arr[$key] = $value;
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
