<?php

namespace Contraption\Collections\Concerns;

use Generator;

trait EnumeratesItems
{
    /**
     * @inheritDoc
     */
    public function contains(mixed ...$values): bool
    {
        foreach ($values as $value) {
            if ($this->find($value) === false) {
                return false;
            }
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function each(callable $operation): static
    {
        foreach ($this as $key => $value) {
            $operation($value, $key);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function find(mixed $value): bool|int|string
    {
        return array_search($value, $this->getItems(), true);
    }

    /**
     * @inheritDoc
     */
    public function first(?callable $comparator = null): mixed
    {
        if ($this->count() === 0) {
            return null;
        }

        if ($comparator !== null) {
            foreach ($this->getItems() as $key => $item) {
                if ($comparator($item, $key) === true) {
                    return $item;
                }
            }

            return null;
        }

        return $this->getItems()[array_key_first($this->getItems())];
    }

    /**
     * @inheritDoc
     */
    public function get(mixed $key, mixed $default = null): mixed
    {
        return $this->getItems()[$key] ?? $default ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): Generator
    {
        foreach ($this->getItems() as $item) {
            yield $item;
        }
    }

    /**
     * @inheritDoc
     */
    public function last(?callable $comparator = null): mixed
    {
        if ($this->count() === 0) {
            return null;
        }

        if ($comparator !== null) {
            return $this->copy()->reverse()->first($comparator);
        }

        return $this->getItems()[array_key_last($this->getItems())];
    }

    /**
     * @inheritDoc
     */
    public function put(mixed $key, mixed $value): static
    {
        $this->items[$key] = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function remove(mixed $key): mixed
    {
        if (array_key_exists($key, $this->items)) {
            $value = $this->get($key);
            unset($this->items[$key]);

            return $value;
        }

        return null;
    }
}