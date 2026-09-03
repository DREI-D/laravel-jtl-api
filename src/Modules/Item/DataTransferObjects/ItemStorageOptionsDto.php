<?php

namespace DREID\LaravelJtlApi\Modules\Item\DataTransferObjects;

readonly class ItemStorageOptionsDto
{
    public function __construct(
        public bool $inventoryManagementActive,
        public bool $splitQuantity,
        public int $globalMinimumStockLevel,
        public int $buffer,
        public bool $serialNumberItem,
        public bool $serialNumberTracking,
        public bool $subjectToShelfLifeExpirationDate,
        public bool $subjectToBatchItem,
        public int $procurementTime,
        public bool $determineProcurementTimeAutomatically,
        public int $additionalHandlingTime,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['inventoryManagementActive'],
            $data['splitQuantity'],
            $data['globalMinimumStockLevel'],
            $data['buffer'],
            $data['serialNumberItem'],
            $data['serialNumberTracking'],
            $data['subjectToShelfLifeExpirationDate'],
            $data['subjectToBatchItem'],
            $data['procurementTime'],
            $data['determineProcurementTimeAutomatically'],
            $data['additionalHandlingTime'],
        );
    }
}
