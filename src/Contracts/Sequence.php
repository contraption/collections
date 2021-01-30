<?php

namespace Contraption\Collections\Contracts;

/**
 * Sequence Contract
 *
 * A sequence is a collection arranged in a single linear dimension. A sequences keys are always sequential
 * starting at 0, meaning that a given values index/key can change dependant on the operations performed.
 *
 * @package Contraption\Collections
 */
interface Sequence extends Enumerable, Transformable, Stackable
{
    /**
     * Put the given values into the collection starting at the provided index, shifting all
     * subsequent values one index to the right.
     *
     * @param int   $index
     * @param mixed ...$values
     *
     * @return static
     */
    public function insert(int $index, mixed ...$values): static;

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
    public function rotate(int $rotations): static;

    /**
     * Adds a single entry to the end of the sequence.
     *
     * @param mixed $value
     *
     * @return $this
     */
    public function add(mixed $value): static;
}