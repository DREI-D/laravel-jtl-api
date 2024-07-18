<?php

namespace DREID\LaravelJtlApi\Modules\AppRegistration;

readonly class TokenDto
{
    public function __construct(
        public string $apiKey
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['ApiKey'],
        );
    }
}
