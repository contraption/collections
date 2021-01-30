<?php

namespace Contraption\Collections;

use Contraption\Collections\Contracts\Stackable;

/**
 * Collections Helper
 *
 * Static helper class for creating new instances of the collections provided
 * by this package.
 *
 * @package Contraption\Collections
 */
final class Collections
{
    /**
     * Create a new map instance.
     *
     * @param iterable|array $items
     *
     * @return \Contraption\Collections\Contracts\Map
     */
    public static function map(iterable $items = []): Map
    {
        return new Map($items);
    }

    /**
     * Create a new flat map instance.
     *
     * @param iterable|array $items
     *
     * @return \Contraption\Collections\FlatMap
     */
    public static function flatMap(iterable $items = []): FlatMap
    {
        return new FlatMap($items);
    }

    /**
     * Create a new multi map instance.
     *
     * @param iterable|array $items
     *
     * @return \Contraption\Collections\MultiMap
     */
    public static function multiMap(iterable $items = []): MultiMap
    {
        return new MultiMap($items);
    }

    /**
     * Create a new queue instance, maps to the stackable.
     *
     * @param iterable $items
     *
     * @return \Contraption\Collections\Contracts\Stackable
     */
    public static function queue(iterable $items = []): Stackable
    {
        return self::stackable($items);
    }

    /**
     * Create a new stackable instance.
     *
     * @param iterable $items
     *
     * @return \Contraption\Collections\Queue
     */
    public static function stackable(iterable $items = []): Queue
    {
        return new Queue($items);
    }

    /**
     * Create a new sequential sequence instance.
     *
     * @param iterable $items
     *
     * @return \Contraption\Collections\Sequence
     */
    public static function sequence(iterable $items = []): Sequence
    {
        return new Sequence($items);
    }

    /**
     * Create a new set instance, sets are unique sequences.
     *
     * @param iterable $items
     *
     * @return \Contraption\Collections\Set
     */
    public static function set(iterable $items = []): Set
    {
        return new Set($items);
    }
}