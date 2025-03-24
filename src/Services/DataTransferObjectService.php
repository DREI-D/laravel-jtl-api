<?php

namespace DREID\LaravelJtlApi\Services;

use Illuminate\Support\Carbon;
use Throwable;

class DataTransferObjectService
{
    public function getArrayValue(array $array, string $key): mixed
    {
        if (!array_key_exists($key, $array)) {
            return null;
        }

        $value = $array[$key];

        if (is_array($value) || is_bool($value)) {
            return $value;
        }

        return $value ?: null;
    }

    public function getDateValue(array $array, string $key): ?Carbon
    {
        $value = $this->getArrayValue($array, $key);

        if (
            $value === '0001-01-01T00:00:00+00:00'
            || $value === null
        ) {
            return null;
        }

        try {
            return Carbon::parse($value);
        } catch (Throwable) {
            return null;
        }
    }
}
