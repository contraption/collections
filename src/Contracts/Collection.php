<?php

namespace Contraption\Collections\Contracts;

use Countable;

/**
 * Collection Contract
 *
 * This is a shared basic contract that all forms of Contraption collections will implement.
 *
 * @package Contraption\Collections
 */
interface Collection extends Countable
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
    public function clear(): static;

    /**
     * Create a new instance of the collection with all items.
     *
     * @return static
     */
    public function copy(): static;

    /**
     * Count the items in the collection.
     *
     * @return int
     */
    public function count(): int;

    /**
     * Check if the collection is empty.
     *
     * @return bool
     */
    public function empty(): bool;

    /**
     * Join all items in the collection to form a string.
     *
     * @param string|null $glue The string to use between all items.
     *
     * @return string If the collection is empty the string will be empty.
     */
    public function join(?string $glue = null): string;

    /**
     * Reduce the collection iteratively to a single value.
     *
     * @param callable $callback Should accept the value and the carry, returning a new carry
     * @param mixed|null     $initial  The initial carry value
     *
     * @return mixed
     */
    public function reduce(callable $callback, mixed $initial = null): mixed;

    /**
     * Return a new collection with a copy of this collections items starting
     * at the provided offset using the optional length.
     *
     * @param int      $offset Index offset to start at, if negative, will start that far from the end.
     * @param int|null $length Optional length
     *
     * @return static
     */
    public function slice(int $offset, int $length = null): static;

    /**
     * Return the sum of all values in the collection.
     *
     * @return int|float
     */
    public function sum(): float|int;
}