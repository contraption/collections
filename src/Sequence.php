<?php

namespace Contraption\Collections;

use Ds;
use InvalidArgumentException;
use OutOfRangeException;

/**
 * Sequence Collection
 *
 * A sequence is a collection arranged in a single linear dimension. A sequences keys are always sequential
 * starting at 0, meaning that a given values index/key can change dependant on the operations performed.
 *
 * @package Contraption\Collections
 */
class Sequence extends Collection implements Contracts\Sequence
{
    protected Ds\Vector $vector;

    public function __construct(?iterable $values = null)
    {
        if ($values !== null) {
            if ($values instanceof Ds\Vector) {
                $this->setDs($values);
            } else {
                $this->setDs(new Ds\Vector($values));
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function contains(...$values): bool
    {
        return $this->getDs()->contains(...$values);
    }

    /**
     * @inheritDoc
     */
    public function find($value): ?int
    {
        $index = $this->getDs()->find($value);

        return $index === false ? null : $index;
    }

    /**
     * @inheritDoc
     */
    public function first()
    {
        return $this->getDs()->first();
    }

    /**
     * @inheritDoc
     */
    public function insert(int $index, ...$values): self
    {
        try {
            $this->getDs()->insert($index, ...$values);
        } catch (OutOfRangeException $exception) {
            throw new InvalidArgumentException('Index provided for insertion is out of range', 0, $exception);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function last()
    {
        return $this->getDs()->last();
    }

    /**
     * @inheritDoc
     */
    public function pop()
    {
        return $this->getDs()->pop();
    }

    /**
     * @inheritDoc
     */
    public function reverse(): self
    {
        $this->getDs()->reverse();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function rotate(int $rotations): self
    {
        $this->getDs()->rotate($rotations);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function shift()
    {
        return $this->getDs()->shift();
    }

    /**
     * @inheritDoc
     */
    public function unshift(...$values): self
    {
        $this->getDs()->unshift(...$values);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function filter(?callable $callback = null): self
    {
        $ds = $this->getDs();

        if ($callback === null) {
            $ds = $ds->filter();
        } else {
            $ds = $ds->filter($callback);
        }

        $this->setDs($ds);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function get($key, $default = null)
    {
        try {
            return $this->getDs()->get($key) ?? $default;
        } catch (OutOfRangeException $exception) {
            return $default;
        }
    }

    /**
     * @inheritDoc
     */
    public function getDs(): Ds\Vector
    {
        return $this->vector;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        foreach ($this->vector as $value) {
            yield $value;
        }
    }

    /**
     * @inheritDoc
     */
    public function join(?string $glue = null): string
    {
        return $this->getDs()->join($glue);
    }

    /**
     * @inheritDoc
     */
    public function map(callable $callback): self
    {
        $this->setDs($this->getDs()->map($callback));

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function merge(iterable $collection): self
    {
        $this->setDs($this->getDs()->merge($collection));

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function push(array $values): self
    {
        $this->getDs()->push(...$values);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function put($key, $value): self
    {
        $this->getDs()->set($key, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function reduce(callable $callback, $initial = null)
    {
        return $this->getDs()->reduce($callback, $initial);
    }

    /**
     * @inheritDoc
     */
    public function remove($key)
    {
        try {
            return $this->getDs()->remove($key);
        } catch (OutOfRangeException $exception) {
            throw new InvalidArgumentException('Index provided for removal is out of range', $exception);
        }
    }

    /**
     * @param \Ds\Collection|\Ds\Vector $collection
     *
     * @return static
     */
    protected function setDs(Ds\Collection $collection): self
    {
        if (! ($collection instanceof Ds\Vector)) {
            throw new InvalidArgumentException('Invalid Ds collection provided');
        }

        $this->vector = $collection;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function slice(int $offset, int $length = null): self
    {
        return new static($this->getDs()->slice($offset, $length));
    }

    /**
     * @inheritDoc
     */
    public function sort(callable $comparator = null): self
    {
        $this->getDs()->sort($comparator);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sum()
    {
        return $this->getDs()->sum();
    }
}