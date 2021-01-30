<?php

namespace Contraption\Collections;

use Contraption\Collections\Concerns\CollectsItems;
use Contraption\Collections\Concerns\TransformsImmutableItems;

class Bag implements Contracts\Bag
{
    use CollectsItems, TransformsImmutableItems;

    private Contracts\Map $map;

    public function __construct()
    {
        $this->map = Collections::map();
    }

    public function __toString(): string
    {
        return $this->join(',');
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->map->get($key, $default);
    }

    public function has(string $key): bool
    {
        return $this->map->has($key);
    }

    public function set(string $key, mixed $value): static
    {
        $this->map->put($key, $value);

        return $this;
    }
}