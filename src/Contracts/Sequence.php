<?php

namespace Contraption\Collections\Contracts;

use Ds;

/**
 * Sequence Contract
 *
 * A sequence is a collection arranged in a single linear dimension. A sequences keys are always sequential
 * starting at 0, meaning that a given values index/key can change dependant on the operations performed.
 *
 * @package Contraption\Collections
 */
interface Sequence extends Collection
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
     * Get the index for a given value.
     *
     * @param $value
     *
     * @return int|null If the value wasn't found null is returned
     */
    public function find($value): ?int;

    /**
     * Get the first value in the collection.
     *
     * @return mixed
     */
    public function first();

    /**
     * Put the given values into the collection starting at the provided index, shifting all
     * subsequent values one index to the right.
     *
     * @param int   $index
     * @param mixed ...$values
     *
     * @return static
     */
    public function insert(int $index, ...$values): self;

    /**
     * Get the last value in the collection.
     *
     * @return mixed
     */
    public function last();

    /**
     * Remove and return the last value in the collection.
     *
     * @return mixed
     */
    public function pop();

    /**
     * Reverse the collection in place.
     *
     * @return static
     */
    public function reverse(): self;

    /**
     * Rotate the collection in place by the amount provided, removing the first value in the
     * collection and adding it to the end. Equivalent to multiple calls to {@see \Contraption\Collections\Contracts\Sequence::shift()}
     * and {@see \Contraption\Collections\Contracts\Sequence::push()}. If the number of rotations
     * is negative this is reversed, instead using {@see \Contraption\Collections\Contracts\Sequence::pop()}
     * and {@see \Contraption\Collections\Contracts\Sequence::unshift()}
     *
     * @param int $rotations
     *
     * @return static
     */
    public function rotate(int $rotations): self;

    /**
     * Remove and return the first value in the collection.
     *
     * @return mixed
     */
    public function shift();

    /**
     * Put the given values on the start of the collection.
     *
     * @param mixed ...$values
     *
     * @return static
     */
    public function unshift(...$values): self;
}