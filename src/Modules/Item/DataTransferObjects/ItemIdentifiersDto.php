<?php

namespace DREID\LaravelJtlApi\Modules\Item\DataTransferObjects;

readonly class ItemIdentifiersDto
{
    public function __construct(
        public ?string $gtin = null,
        public ?string $manufacturerNumber = null,
        public ?string $isbn = null,
        public ?string $upc = null,
        public ?string $amazonFnsku = null,
        public array $asins = [],
        public ?string $ownIdentifier = null,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Gtin'] ?: null,
            $data['ManufacturerNumber'] ?: null,
            $data['ISBN'] ?: null,
            $data['UPC'] ?: null,
            $data['AmazonFnsku'] ?: null,
            $data['Asins'],
            $data['OwnIdentifier'] ?: null,
        );
    }
}
