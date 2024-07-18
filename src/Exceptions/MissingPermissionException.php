<?php

namespace DREID\LaravelJtlApi\Exceptions;

use Exception;

class MissingPermissionException extends Exception
{
    public function __construct(string $message, public readonly array $permissions)
    {
        parent::__construct($message);
    }

    public static function one(string $permission): static
    {
        return new static('This permission is not enabled: ' . $permission, [$permission]);
    }

    public static function oneOf($permissions): static
    {
        return new static(
            'At least one of these permissions has to be enabled: ' . implode(', ', $permissions),
            $permissions
        );
    }

    public static function all($permissions): static
    {
        return new static(
            'All of these permissions have to be enabled: ' . implode(', ', $permissions),
            $permissions
        );
    }
}
