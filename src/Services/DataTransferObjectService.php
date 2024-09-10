<?php

namespace DREID\LaravelJtlApi\Services;

class DataTransferObjectService
{
    public function getArrayValue(array $array, string $key): mixed
    {
        if (!array_key_exists($key, $array)) {
            return null;
        }

        $value = $array[$key];

        if (is_array($value)) {
            return $value;
        }

        return $value ?: null;
    }
}
