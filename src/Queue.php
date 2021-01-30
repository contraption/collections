<?php

namespace Contraption\Collections;

class Queue implements Contracts\Stackable
{
    use Concerns\CollectsItems;

    public function __construct(iterable $items = [])
    {
        $this->setItems($items);
    }

    /**
     * @inheritDoc
     */
    public function peek(int $direction = self::DIRECTION_TOP): mixed
    {
        if ($this->count() > 0) {
            if ($direction === self::DIRECTION_TOP) {
                return $this->items[0];
            }

            if ($direction === self::DIRECTION_BOTTOM) {
                return $this->items[array_key_last($this->items)];
            }
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function pop(): mixed
    {
        $item = array_pop($this->items);
        $this->setItems(array_values($this->items));

        return $item;
    }

    /**
     * @inheritDoc
     */
    public function push(array $values): static
    {
        foreach ($values as $value) {
            $this->items[] = $value;
        }
        $this->setItems(array_values($this->items));

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function shift(): mixed
    {
        $item = array_shift($this->items);
        $this->setItems(array_values($this->items));

        return $item;
    }

    /**
     * @inheritDoc
     */
    public function unshift(...$values): static
    {
        array_unshift($this->items, ...$values);
        $this->setItems(array_values($this->items));

        return $this;
    }
}