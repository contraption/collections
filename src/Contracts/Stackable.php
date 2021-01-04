<?php

namespace Contraption\Collections\Contracts;

interface Stackable
{
    /**
     * Look from the top down.
     */
    public const DIRECTION_TOP = 0;

    /**
     * Look from the bottom up.
     */
    public const DIRECTION_BOTTOM = 1;

    /**
     * Peek at the next value.
     *
     * @param int $direction
     *
     * @return mixed
     */
    public function peek(int $direction = self::DIRECTION_TOP): mixed;

    /**
     * Remove and return the last value in the collection.
     *
     * @return mixed
     */
    public function pop(): mixed;

    /**
     * Push all of the values onto the collection.
     *
     * @param array $values
     *
     * @return static
     */
    public function push(array $values): static;

    /**
     * Remove and return the first value in the collection.
     *
     * @return mixed
     */
    public function shift(): mixed;

    /**
     * Put the given values on the start of the collection.
     *
     * @param mixed ...$values
     *
     * @return static
     */
    public function unshift(mixed ...$values): static;
}