<?php

namespace Contraption\Collections;

/**
 * Map
 *
 * A map is a sequential collection of key-value pairs, virtually identical to an array.
 *
 * @package Contraption\Collections
 */
class Map implements Contracts\Map
{
    use Concerns\EnumeratesItems,
        Concerns\TransformsItems,
        Concerns\CollectsItems;

    public function __construct(iterable $items = [])
    {
        $this->setItems($items);
    }

    /**
     * @inheritDoc
     */
    public function diff(Contracts\Map $map): static
    {
        $diffedMap = new static;

        foreach ($this as $key => $value) {
            if (! $map->has($key)) {
                $diffedMap->put($key, $value);
            }
        }

        return $diffedMap;
    }

    /**
     * @inheritDoc
     */
    public function firstKey(): mixed
    {
        return array_key_first($this->getItems());
    }

    /**
     * @inheritDoc
     */
    public function has($key): bool
    {
        return array_key_exists($this->getItems(), $key);
    }

    /**
     * @inheritDoc
     */
    public function intersect(Contracts\Map $map): static
    {
        $intersectedMap = new static;

        foreach ($this as $key => $value) {
            if ($map->has($key)) {
                $intersectedMap->put($key, $value);
            }
        }

        return $intersectedMap;
    }

    /**
     * @inheritDoc
     */
    public function keys(): Contracts\Sequence
    {
        return new Set(array_keys($this->getItems()));
    }

    /**
     * @inheritDoc
     */
    public function ksort(callable $comparator = null): static
    {
        if ($comparator) {
            uksort($this->items, $comparator);
        } else {
            ksort($this->items);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lastKey(): null|int|string
    {
        return array_key_last($this->getItems());
    }

    /**
     * @inheritDoc
     */
    public function xor(Contracts\Map $map): static
    {
        return $this->merge($map)->filter(function ($key) use ($map) {
            return $this->has($key) ^ $map->has($key);
        });
    }
}