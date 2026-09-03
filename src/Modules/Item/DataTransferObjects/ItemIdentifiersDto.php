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
            $service->getArrayValue($data, 'gtin'),
            $service->getArrayValue($data, 'manufacturerNumber'),
            $service->getArrayValue($data, 'isbn'),
            $service->getArrayValue($data, 'upc'),
            $service->getArrayValue($data, 'amazonFnsku'),
            $service->getArrayValue($data, 'asins'),
            $service->getArrayValue($data, 'ownIdentifier'),
        );
    }
}
