<?php

namespace Contraption\Collections;

class MultiMap extends Map
{
    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $items = parent::all();

        foreach ($items as $key => $value) {
            $items[$key] = $value->all();
        }

        return $items;
    }

    /**
     * @inheritDoc
     */
    public function contains(mixed ...$values): bool
    {
        foreach ($values as $key => $value) {
            if ($this->find($value) !== false) {
                unset($values[$key]);
            }
        }

        return empty($values);
    }

    /**
     * @inheritDoc
     */
    public function find($value): bool|int|string
    {
        foreach ($this->items as $key => $sequence) {
            if ($sequence->find($value) !== false) {
                return $key;
            }
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function merge(iterable $collection): static
    {
        foreach ($collection as $key => $value) {
            if (! ($value instanceof Contracts\Sequence)) {
                $value = new Sequence(is_iterable($value) ? $value : [$value]);
            }

            if (! isset($this->items[$key])) {
                $this->items[$key] = $value;
            } else {
                $this->items[$key]->merge($value);
            }
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function put($key, $value): static
    {
        if ($this->has($key)) {
            $this->get($key)->push($value);
        } else {
            $this->items[$key] = new Sequence($value);
        }

        return $this;
    }

    /**
     * Identical to {@see \Contraption\Collections\MultiMap::put()} except that it will
     * overwrite the values if the key is already present.
     *
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function set($key, $value): static
    {
        if (! ($value instanceof Contracts\Sequence)) {
            $value = new Sequence(is_iterable($value) ? $value : [$value]);
        }

        $this->items[$key] = $value;

        return $this;
    }
}