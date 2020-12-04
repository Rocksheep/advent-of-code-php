<?php

namespace App;

class Collection implements \Iterator
{
    private array $values;
    private int $position;

    public function __construct()
    {
        $this->values = [];
        $this->position = 0;
    }

    static public function fromArray(array $values)
    {
        $instance = new self();

        foreach ($values as $value) {
            $instance->add($value);
        }

        return $instance;
    }

    public function count(): int
    {
        return count($this->values);
    }

    public function add($value)
    {
        $this->values[] = $value;
    }

    public function get($index)
    {
        return $this->values[$index];
    }

    public function set($index, $value)
    {
        $this->values[$index] = $value;
    }

    public function hasKey($index)
    {
        return isset($this->values[$index]);
    }

    public function last()
    {
        return $this->values[count($this->values) - 1];
    }

    public function map(callable $callback)
    {
        return self::fromArray(array_map($callback, $this->values));
    }

    public function reduce(callable $callback, $startingValue)
    {
        return array_reduce($this->values, $callback, $startingValue);
    }

    public function each(callable $callback)
    {
        foreach ($this->values as $i => $value) {
            $result = $callback($value, $i);

            if ($result === false) {
                break;
            }
        }
    }

    public function current()
    {
        return $this->values[$this->position];
    }

    public function next()
    {
        $this->position++;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid()
    {
        return isset($this->values[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }
}
