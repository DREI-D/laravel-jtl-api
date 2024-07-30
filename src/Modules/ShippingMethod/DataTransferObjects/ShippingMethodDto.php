<?php

namespace DREID\LaravelJtlApi\Modules\ShippingMethod\DataTransferObjects;

readonly class ShippingMethodDto
{
    public function __construct(
        public int $id,
        public string $name,
        public int $priority,
        public float $grossPrice,
        public float $extraWeight,
        public bool $isAmazonPrime,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Id'],
            $data['Name'],
            $data['Priority'],
            $data['GrossPrice'],
            $data['ExtraWeight'],
            $data['IsAmazonPrime'],
        );
    }
}
