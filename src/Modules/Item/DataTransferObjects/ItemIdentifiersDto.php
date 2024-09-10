<?php

namespace DREID\LaravelJtlApi\Modules\Item\DataTransferObjects;

use DREID\LaravelJtlApi\Services\DataTransferObjectService;

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
        $service = app(DataTransferObjectService::class);

        return new self(
            $service->getArrayValue($data, 'Gtin'),
            $service->getArrayValue($data, 'ManufacturerNumber'),
            $service->getArrayValue($data, 'ISBN'),
            $service->getArrayValue($data, 'UPC'),
            $service->getArrayValue($data, 'AmazonFnsku'),
            $service->getArrayValue($data, 'Asins'),
            $service->getArrayValue($data, 'OwnIdentifier'),
        );
    }
}
