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

    public function add($value)
    {
        $this->values[] = $value;
    }

    public function get(int $index)
    {
        return $this->values[$index];
    }

    public function map(callable $callback)
    {
        return self::fromArray(array_map($callback, $this->values));
    }

    public function reduce(callable $callback, $startingValue)
    {
        return array_reduce($this->values, $callback, $startingValue);
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
