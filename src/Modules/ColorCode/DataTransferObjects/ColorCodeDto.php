<?php

namespace DREID\LaravelJtlApi\Modules\ColorCode\DataTransferObjects;

readonly class ColorCodeDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $code,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Id'],
            $data['Name'],
            $data['Code'],
        );
    }
}
