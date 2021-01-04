<?php

namespace Contraption\Collections;

use Contraption\Collections\Contracts\Stackable;
use InvalidArgumentException;
use OutOfRangeException;

/**
 * Sequence
 *
 * A sequence is a collection arranged in a single linear dimension. A sequences keys are always sequential
 * starting at 0, meaning that a given values index/key can change dependant on the operations performed.
 *
 * @package Contraption\Collections
 */
class Sequence implements Contracts\Sequence
{
    use Concerns\EnumeratesItems,
        Concerns\TransformsItems,
        Concerns\StacksItems,
        Concerns\CollectsItems;

    public function __construct(iterable $items = [])
    {
        $this->setItems($items);
    }

    private function checkIndex(mixed $key): void
    {
        if (! is_int($key)) {
            throw new InvalidArgumentException('Sequence keys/indexes must be integers');
        }

        if ($key > $this->count()) {
            throw new OutOfRangeException(sprintf('Index %s is out of range for this sequence', $key));
        }
    }

    /**
     * @inheritDoc
     */
    public function insert(int $index, mixed ...$values): static
    {
        $this->checkIndex($index);

        array_splice($this->items, $index, 0, $values);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function peek(int $direction = Stackable::DIRECTION_TOP): mixed
    {
        if ($direction === Stackable::DIRECTION_TOP) {
            return $this->first();
        }

        if ($direction === Stackable::DIRECTION_BOTTOM) {
            return $this->last();
        }

        throw new InvalidArgumentException(sprintf('Invalid direction for peeking: %s', $direction));
    }

    /**
     * @inheritDoc
     */
    public function put(mixed $key, mixed $value): static
    {
        $this->checkIndex($key);
        $this->items[$key] = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function remove(mixed $key): mixed
    {
        $this->checkIndex($key);

        if (array_key_exists($key, $this->getItems())) {
            $value = $this->get($key);
            unset($this->items[$key]);
            $this->resetKeys();

            return $value;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function rotate(int $rotations): static
    {
        $rotations = $this->normaliseRotations($rotations);

        for ($i = $rotations; $i > 0; $i--) {
            $this->push($this->shift());
        }

        return $this;
    }

    private function normaliseRotations(int $rotations): int
    {
        $count = $this->count();

        if ($count < 2) {
            return 0;
        }

        return $rotations < 0 ? $count - (abs($rotations) % $count) : $rotations % $count;
    }

    private function resetKeys(): void
    {
        $this->items = array_values($this->items);
    }

    public function unique(): Set
    {
        return new Set($this->getItems());
    }
}