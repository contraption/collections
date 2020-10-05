<?php

namespace Contraption\Collections;

use Ds;

/**
 * Abstract Collection
 *
 * This class is intended as an abstract parent to provide collection functionality without
 * having to manually implement {@see \Contraption\Collections\Contracts\Collection}.
 *
 * @package Contraption\Collections
 */
abstract class Collection implements Contracts\Collection
{
    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $this->getDs()->toArray();
    }

    /**
     * @inheritDoc
     */
    public function clear(): Contracts\Collection
    {
        $this->getDs()->clear();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function count(): bool
    {
        return $this->getDs()->count();
    }

    /**
     * @inheritDoc
     */
    public function empty(): bool
    {
        return $this->getDs()->isEmpty();
    }

    /**
     * @inheritDoc
     */
    public function copy(): self
    {
        $clone = new static;
        $clone->setDs($this->getDs()->copy());

        return $clone;
    }

    /**
     * @inheritDoc
     */
    abstract protected function setDs(Ds\Collection $collection): self;
}