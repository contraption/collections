<?php

namespace Contraption\Collections\Contracts;

use Stringable;

interface Bag extends Collection, Stringable
{
    public function get(mixed $key, mixed $default = null): mixed;

    public function set(mixed $key, mixed $value);
}