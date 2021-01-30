<?php

namespace Contraption\Collections\Contracts;

use Stringable;

/**
 * Bag Contract
 *
 * A bag is a simplified {@see \Contraption\Collections\Contracts\Map}, providing a
 * key => value structure that can be reduced/joined as well as transformed. Outside
 * of these operations a bag only contains a basic get and set method. Keys are
 * always strings.
 *
 * @package Contraption\Collections
 */
interface Bag extends Collection, Transformable, Stringable
{
    public function get(string $key, mixed $default = null): mixed;

    public function set(string $key, mixed $value): static;

    public function has(string $key): bool;
}