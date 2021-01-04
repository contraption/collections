<?php

namespace Contraption\Collections;

/**
 * Flat Map
 *
 * A flat map stores all values in a single linear layer, using dot notation to flatten
 * arrays. Returned values are always expanded to their original form.
 *
 * @package Contraption\Collections
 */
class FlatMap extends Map
{
    public const SEPARATOR = '.';

    public function __construct(iterable $items = [])
    {
        parent::__construct($this->flattenItems($items));
    }

    private function expandItems(iterable $items): array
    {
        $expanded = [];
        $current  = &$expanded;

        foreach ($items as $key => $value) {
            if (str_contains($key, '.')) {
                $keyParts = explode('.', $key);
                $lastKey  = array_pop($keyParts);

                foreach ($keyParts as $keyPart) {
                    $current[$keyPart] = [];
                    $current           = &$current[$keyPart];
                }

                $current[$lastKey] = $value;
            } else {
                $expanded[$key] = $value;
            }
        }

        return $expanded;
    }

    private function flattenItems(iterable $items, string $prefix = ''): array
    {
        $flattened = [];

        foreach ($items as $key => $value) {
            if (is_iterable($value) && ! empty($value)) {
                $flattened[] = $this->flattenItems($value, $prefix . $key . self::SEPARATOR);
            } else {
                $flattened[] = [$prefix . $key => $value];
            }
        }

        return array_merge(...$flattened);
    }

    public function get($key, $default = null): mixed
    {
        $result = $this->getChildren($key);

        if (empty($result)) {
            return $default;
        }

        if (count($result) === 1) {
            return is_array($result) ? $this->expandItems($result[0]) : $result[0];
        }

        return $this->expandItems($result);
    }

    private function getChildren(string $key, iterable $items = null): array
    {
        $items ??= $this;

        if (isset($items[$key])) {
            return [$items[$key]];
        }

        $result = [];

        foreach ($items as $itemKey => $itemValue) {
            if (str_starts_with($itemKey, $key)) {
                $result[trim(str_replace($key, '', $itemKey), self::SEPARATOR)] = $itemValue;
            }
        }

        return $result;
    }

    public function has($key): bool
    {
        if (isset($this[$key])) {
            return true;
        }

        foreach ($this as $itemKey => $itemValue) {
            if (str_starts_with($itemKey, $key)) {
                return true;
            }
        }

        return false;
    }

    public function all(): array
    {
        return $this->expandItems($this->items);
    }

    public function keys(): Contracts\Sequence
    {
        return new Set(array_keys($this->items));
    }
}