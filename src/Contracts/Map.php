<?php

namespace Contraption\Collections\Contracts;

use Ds\Pair;

/**
 * Map Contract
 *
 * A map is a sequential collection of key-value pairs, virtually identical to an array. Unlike arrays,
 * a maps key can be anything, even objects, as long as it's unique. Object keys must implement
 * {@see \Ds\Hashable}.
 *
 * @method \Ds\Map getDs()
 *
 * @package Contraption\Collections
 */
interface Map extends Collection
{
    /**
     * See if all of the given values are contained within the collection.
     *
     * @param mixed ...$values
     *
     * @return bool
     */
    public function contains(...$values): bool;

    /**
     * Create a new map containing all items that do not have corresponding
     * keys in the provided map.
     *
     * @param \Contraption\Collections\Contracts\Map $map
     *
     * @return self
     */
    public function diff(Map $map): self;

    /**
     * Get the first value in the collection.
     *
     * @return mixed
     */
    public function first();

    /**
     * Get the key for the first entry in the collection.
     *
     * @return mixed
     */
    public function firstKey();

    /**
     * Get the first {@see \Ds\Pair} in the collection.
     *
     * @return \Ds\Pair|null
     */
    public function firstPair(): ?Pair;

    /**
     * See if an entry exists with the given key.
     *
     * @param $key
     *
     * @return bool
     */
    public function has($key): bool;

    /**
     * Create a new map containing all items that have corresponding keys in
     * the provided map.
     *
     * @param \Contraption\Collections\Contracts\Map $map
     *
     * @return static
     */
    public function intersect(self $map): self;

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
    public function ksort(callable $comparator = null): self;

    /**
     * Get the last value in the collection.
     *
     * @return mixed
     */
    public function last();

    /**
     * Get the key for the last value in the collection.
     *
     * @return mixed
     */
    public function lastKey();

    /**
     * Get the last {@see \Ds\Pair} in the collection.
     *
     * @return \Ds\Pair|null
     */
    public function lastPair(): ?Pair;

    /**
     * Get the collection as a collection of pairs.
     *
     * @return \Contraption\Collections\Contracts\Sequence
     *                                                    
     * @see \Ds\Pair
     */
    public function pairs(): Sequence;

    /**
     * Reverse the order of the items in this collection.
     *
     * @return static
     */
    public function reverse(): self;

    /**
     * Create a new map containing all items that have keys in the current or
     * provided map, but not both.
     *
     * @param \Contraption\Collections\Contracts\Map $map
     *
     * @return static
     */
    public function xor(Map $map): self;
}