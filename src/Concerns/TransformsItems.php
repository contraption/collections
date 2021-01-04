<?php

namespace Contraption\Collections\Concerns;

trait TransformsItems
{
    /**
     * @inheritDoc
     */
    public function map(callable $callback): static
    {
        foreach ($this as $key => $value) {
            $this->items[$key] = $callback($value, $key);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function merge(iterable $collection): static
    {
        $this->items = array_merge($this->getItems(), $collection);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function reverse(): static
    {
        $this->items = array_reverse($this->getItems());

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sort(callable $comparator = null): static
    {
        if ($comparator === null) {
            sort($this->items);
        } else {
            usort($this->items, $comparator);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function filter(?callable $callback = null): static
    {
        $this->items = array_filter($this->getItems(), $callback);

        return $this;
    }
}