<?php

namespace DREID\LaravelJtlApi\Modules\Item\DataTransferObjects;

readonly class ItemWeightsDto
{
    public function __construct(
        public float $itemWeight,
        public float $shippingWeight,
    ) {}

    public static function fromResponse(array $data): static
    {
        /** @noinspection SpellCheckingInspection */
        return new self(
            $data['ItemWeigth'],
            $data['ShippingWeight'],
        );
    }
}
