<?php

namespace Contraption\Collections\Contracts;

use Countable;
use Ds;
use IteratorAggregate;

/**
 * Collection Contract
 *
 * This is a shared contract that all forms of Contraption collections will implement.
 *
 * @package Contraption\Collections
 */
interface Collection extends IteratorAggregate, Countable
{
    /**
     * Get the entire collection as an array.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Remove all items from the collection.
     *
     * @return static
     */
    public function clear(): self;

    /**
     * Create a new instance of the collection with all items.
     *
     * @return static
     */
    public function copy(): self;

    /**
     * Count the items in the collection.
     *
     * @return bool
     */
    public function count(): bool;

    /**
     * Check if the collection is empty.
     *
     * @return bool
     */
    public function empty(): bool;

    /**
     * Filter the collection in place, optionally using a provided callback.
     *
     * @param callable|null $callback Callback should return true to include the value
     *                                or false to skip. If this callback is null a boolean
     *                                test will be used.
     *
     * @return static
     */
    public function filter(?callable $callback = null): self;

    /**
     * Get the value for the provided key.
     *
     * @param      $key
     * @param null $default A default value that should be returned if the value fails a
     *                      boolean test.
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Get the underlying DS object used for this collection.
     *
     * @return \Ds\Collection
     */
    public function getDs(): Ds\Collection;

    /**
     * Join all items in the collection to form a string.
     *
     * @param string|null $glue The string to use between all items.
     *
     * @return string If the collection is empty the string will be empty.
     */
    public function join(?string $glue = null): string;

    /**
     * Map the collection in place applying the callback to all items.
     *
     * @param callable $callback
     *
     * @return static
     */
    public function map(callable $callback): self;

    /**
     * Merge a collection into this one.
     *
     * @param iterable $collection The data can be any iterable, not just a collection.
     *
     * @return static
     */
    public function merge(iterable $collection): self;

    /**
     * Push all of the values onto the collection. For keyless collections all values are
     * appended onto the collection, otherwise their keys in the array will be used.
     *
     * @param array $values
     *
     * @return static
     */
    public function push(array $values): self;

    /**
     * Add the value to the collection using the provided key.
     *
     * @param $key
     * @param $value
     *
     * @return static
     */
    public function put($key, $value): self;

    /**
     * Reduce the collection iteratively to a single value.
     *
     * @param callable $callback Should accept the value and the carry, returning a new carry
     * @param null     $initial  The initial carry value
     *
     * @return mixed
     */
    public function reduce(callable $callback, $initial = null);

    /**
     * Remove an item from the collection and return it.
     *
     * @param $key
     *
     * @return mixed
     */
    public function remove($key);

    /**
     * Return a new collection with a copy of this collections items starting
     * at the provided offset using the optional length.
     *
     * @param int      $offset Index offset to start at, if negative, will start that far from the end.
     * @param int|null $length Optional length
     *
     * @return static
     */
    public function slice(int $offset, int $length = null): self;

    /**
     * Sort the collection in place.
     *
     * @param callable|null $comparator Accepts two values, should return result of a <=> b
     *
     * @return static
     */
    public function sort(callable $comparator = null): self;

    /**
     * Return the sum of all values in the collection.
     *
     * @return int|float
     */
    public function sum();
}