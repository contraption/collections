<?php

namespace Contraption\Collections\Contracts;

/**
 * Bag Contract
 *
 * A bag is an object that holds another collection, specifically a {@see \Contraption\Collections\Contracts\Map}.
 * A bag is mutable, but it isn't transformable.
 *
 * A good example of a bag in use would be one that contains the HTTP headers either for an incoming or outgoing
 * request. The underlying features of a collection would seldom be required in instances such as these.
 *
 * @package Contraption\Collections
 */
interface Bag
{
    /**
     * Get the entire bag as an array.
     *
     * @return array
     * @see \Contraption\Collections\Contracts\Collection::all()
     */
    public function all(): array;

    /**
     * Get the underlying collection.
     *
     * @return \Contraption\Collections\Contracts\Map
     */
    public function collection(): Map;

    /**
     * See if all of the given values are contained within the bag.
     *
     * @param mixed ...$values
     *
     * @return bool
     */
    public function contains(...$values): bool;

    /**
     * Get the value for the provided key.
     *
     * @param string $key
     * @param null   $default A default value that should be returned if the value fails a
     *                        boolean test.
     *
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * See if all of the given keys are present within the bag.
     *
     * @param mixed ...$keys
     *
     * @return bool
     */
    public function has(...$keys): bool;

    /**
     * Add the value to the bag using the provided key.
     *
     * @param string $key
     * @param        $value
     *
     * @return $this
     */
    public function set(string $key, $value): self;
}