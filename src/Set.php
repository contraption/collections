<?php

namespace Contraption\Collections;

/**
 * Set
 *
 * A set is a sequence that only contains unique values.
 *
 * @package Contraption\Collections
 */
class Set extends Sequence
{
    public function __construct(iterable $items = [])
    {
        parent::__construct($items);

        $this->makeUnique();
    }

    /**
     * @inheritDoc
     */
    public function insert(int $index, mixed ...$values): static
    {
        parent::insert($index, $values);

        $this->makeUnique();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function map(callable $callback): static
    {
        parent::map($callback);

        $this->makeUnique();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function merge(iterable $collection): static
    {
        parent::merge($collection);

        $this->makeUnique();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function push(mixed ...$values): static
    {
        parent::push($values);

        $this->makeUnique();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function put(mixed $key, mixed $value): static
    {
        parent::put($key, $value);

        $this->makeUnique();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function unshift(mixed ...$values): static
    {
        parent::unshift($values);

        $this->makeUnique();

        return $this;
    }

    private function makeUnique(): void
    {
        $this->items = array_unique($this->items);
    }
}