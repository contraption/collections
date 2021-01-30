<?php

namespace Contraption\Collections\Concerns;

trait CollectsItems
{
    protected array $items;

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return (array) $this->getItems();
    }

    /**
     * @inheritDoc
     */
    public function clear(): static
    {
        $this->items = [];

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function copy(): static
    {
        return new static($this->getItems()());
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->getItems()());
    }

    /**
     * @inheritDoc
     */
    public function empty(): bool
    {
        return $this->count() === 0;
    }

    /**
     * @inheritDoc
     */
    public function join(?string $glue = null): string
    {
        return implode($glue, $this->getItems()());
    }

    /**
     * @inheritDoc
     */
    public function reduce(callable $callback, mixed $initial = null): mixed
    {
        return array_reduce($this->getItems()(), $callback, $initial);
    }

    /**
     * @inheritDoc
     */
    public function slice(int $offset, int $length = null): static
    {
        return new static(array_slice($this->getItems(), $offset, $length));
    }

    /**
     * @inheritDoc
     */
    public function sum(): float|int
    {
        return array_sum($this->getItems());
    }

    protected function getItems(): array
    {
        return $this->items;
    }

    protected function setItems(array $items): static
    {
        $this->items = $items;

        return $this;
    }
}