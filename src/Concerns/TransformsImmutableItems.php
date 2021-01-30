<?php

namespace Contraption\Collections\Concerns;

trait TransformsImmutableItems
{
    abstract public function copy(): static;

    /**
     * @inheritDoc
     */
    public function map(callable $callback): static
    {
        $copy = $this->copy();

        foreach ($copy as $key => $value) {
            $copy->items[$key] = $callback($value, $key);
        }

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function merge(iterable $collection): static
    {
        $copy = $this->copy();
        $copy->items = array_merge($this->getItems(), $collection);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function reverse(): static
    {
        $copy = $this->copy();
        $copy->items = array_reverse($copy->getItems());

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function sort(callable $comparator = null): static
    {
        $copy = $this->copy();

        if ($comparator === null) {
            sort($copy->items);
        } else {
            usort($copy->items, $comparator);
        }

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function filter(?callable $callback = null): static
    {
        $copy = $this->copy();
        $copy->items = array_filter($copy->getItems(), $callback);

        return $copy;
    }
}