<?php

namespace Contraption\Collections\Contracts;

interface Transformable
{
    /**
     * Filter the collection in place, optionally using a provided callback.
     *
     * @param callable|null $callback Callback should return true to include the value
     *                                or false to skip. If this callback is null a boolean
     *                                test will be used.
     *
     * @return static
     */
    public function filter(?callable $callback = null): static;

    /**
     * Map the collection in place applying the callback to all items.
     *
     * @param callable $callback
     *
     * @return static
     */
    public function map(callable $callback): static;

    /**
     * Merge a collection into this one.
     *
     * @param iterable $collection The data can be any iterable, not just a collection.
     *
     * @return static
     */
    public function merge(iterable $collection): static;

    /**
     * Reverse the order of the items in this collection.
     *
     * @return static
     */
    public function reverse(): static;

    /**
     * Sort the collection in place.
     *
     * @param callable|null $comparator Accepts two values, should return result of a <=> b
     *
     * @return static
     */
    public function sort(callable $comparator = null): static;
}