<?php

namespace DREID\LaravelJtlApi\Modules\Item\DataTransferObjects;

readonly class ItemDimensionsDto
{
    public function __construct(
        public float $length,
        public float $width,
        public float $height,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['length'],
            $data['width'],
            $data['height'],
        );
    }
}
