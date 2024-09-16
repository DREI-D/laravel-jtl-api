<?php

namespace DREID\LaravelJtlApi\Modules\Warehouse\DataTransferObjects;

use DREID\LaravelJtlApi\Services\DataTransferObjectService;

readonly class StorageLocationDto
{
    public function __construct(
        public int $id,
        public int $warehouseId,
        public string $name,
        public ?int $sortNumber,
        public ?int $priority,
        public bool $lockForShipment,
        public bool $lockForAvailability,
        public ?string $comment,
    ) {}

    public static function fromResponse(array $data): static
    {
        $service = app(DataTransferObjectService::class);

        return new self(
            $data['Id'],
            $data['WarehouseId'],
            $data['Name'],
            $service->getArrayValue($data, 'SortNumber'),
            $service->getArrayValue($data, 'Priority'),
            $service->getArrayValue($data, 'LockForShipment'),
            $service->getArrayValue($data, 'LockForAvailability'),
            $service->getArrayValue($data, 'Comment'),
        );
    }
}
