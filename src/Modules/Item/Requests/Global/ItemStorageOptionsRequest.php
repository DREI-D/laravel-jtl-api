<?php

namespace DREID\LaravelJtlApi\Modules\Item\Requests\Global;

readonly class ItemStorageOptionsRequest
{
    public function __construct(
        public ?bool $inventoryManagementActive = null,
        public ?bool $splitQuantity = null,
        public ?int $globalMinimumStock = null,
        public ?int $buffer = null,
        public ?bool $serialNumberItem = null,
        public ?bool $serialNumberTracking = null,
        public ?bool $subjectToShelfLifeExpirationDate = null,
        public ?bool $subjectToBatchItem = null,
        public ?int $procurementTime = null,
        public ?bool $determineProcurementTimeAutomatically = null,
        public ?int $additionalHandlingTime = null,
    ) {}
}
