<?php

namespace Contraption\Collections\Concerns;

trait StacksItems
{
    /**
     * @inheritDoc
     */
    public function pop(): mixed
    {
        return array_pop($this->items);
    }

    /**
     * @inheritDoc
     */
    public function shift(): mixed
    {
        return array_shift($this->items);
    }

    /**
     * @inheritDoc
     */
    public function unshift(mixed ...$values): static
    {
        array_unshift($this->items, $values);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function push(mixed ...$values): static
    {
        foreach ($values as $value) {
            $this->items[] = $value;
        }

        return $this;
    }
}