<?php

namespace Contraption\Collections\Contracts;

/**
 * Map Contract
 *
 * A map is a sequential collection of key-value pairs, virtually identical to an array.
 *
 * @package Contraption\Collections
 */
interface Map extends Enumerable, Transformable
{
    /**
     * Create a new map containing all items that do not have corresponding
     * keys in the provided map.
     *
     * @param \Contraption\Collections\Contracts\Map $map
     *
     * @return static
     */
    public function diff(Map $map): static;

    /**
     * Get the key for the first entry in the collection.
     *
     * @return mixed
     */
    public function firstKey(): mixed;

    /**
     * See if an entry exists with the given key.
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function has(mixed $key): bool;

    /**
     * Create a new map containing all items that have corresponding keys in
     * the provided map.
     *
     * @param \Contraption\Collections\Contracts\Map $map
     *
     * @return static
     */
    public function intersect(self $map): static;

    /**
     * Get a sequence all of keys in the collection.
     *
     * @return \Contraption\Collections\Contracts\Sequence
     */
    public function keys(): Sequence;

    /**
     * Sort the collection in place by their keys, using an optional comparator.
     *
     * @param callable|null $comparator
     *
     * @return static
     */
    public function ksort(callable $comparator = null): static;

    /**
     * Get the key for the last value in the collection.
     *
     * @return mixed
     */
    public function lastKey(): mixed;

    /**
     * Create a new map containing all items that have keys in the current or
     * provided map, but not both.
     *
     * @param \Contraption\Collections\Contracts\Map $map
     *
     * @return static
     */
    public function xor(Map $map): static;
}