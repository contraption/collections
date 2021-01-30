<?php

namespace Contraption\Collections\Contracts;

use IteratorAggregate;

/**
 * Enumerable Contract
 *
 * An enumerable collection is one where you can freely access all items.
 * From retrieving all, to getting or setting any.
 *
 * @package Contraption\Collections\Contracts
 */
interface Enumerable extends Collection, IteratorAggregate
{
    /**
     * See if all of the given values are contained within the collection.
     *
     * @param mixed ...$values
     *
     * @return bool
     */
    public function contains(mixed ...$values): bool;

    /**
     * Perform the provided operation on all items in the collection.
     *
     * @param callable $operation
     *
     * @return static
     */
    public function each(callable $operation): static;

    /**
     * Get the index or key for a given value.
     *
     * @param mixed $value
     *
     * @return mixed If the value wasn't found false is returned
     */
    public function find(mixed $value): mixed;

    /**
     * Get the first value in the collection.
     *
     * @param callable|null $comparator
     *
     * @return mixed
     */
    public function first(?callable $comparator = null): mixed;

    /**
     * Get the value for the provided key.
     *
     * @param mixed $key
     * @param null  $default A default value that should be returned if the value fails a
     *                       boolean test.
     *
     * @return mixed
     */
    public function get(mixed $key, mixed $default = null): mixed;

    /**
     * Get the last value in the collection.
     *
     * @param callable|null $comparator
     *
     * @return mixed
     */
    public function last(?callable $comparator = null): mixed;

    /**
     * Add the value to the collection using the provided key.
     *
     * @param mixed $key
     * @param mixed $value
     *
     * @return static
     */
    public function put(mixed $key, mixed $value): static;

    /**
     * Remove an item from the collection and return it.
     *
     * @param mixed $key
     *
     * @return mixed
     */
    public function remove(mixed $key): mixed;
}