<?php

namespace Nscps\Ds\Arrays;

class AssocArray extends AbstractArray
{

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
     * @param string $key
     * @return $this
     */
    public function remove(string $key): AssocArray
    {
        if ($this->has($key)) {
            unset($this->arr[$key]);
        }
        return $this;
    }

}
