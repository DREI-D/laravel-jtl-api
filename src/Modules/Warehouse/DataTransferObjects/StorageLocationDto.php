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
            $data['id'],
            $data['warehouseId'],
            $data['name'],
            $service->getArrayValue($data, 'sortNumber'),
            $service->getArrayValue($data, 'priority'),
            $service->getArrayValue($data, 'lockForShipment'),
            $service->getArrayValue($data, 'lockForAvailability'),
            $service->getArrayValue($data, 'comment'),
        );
    }
}
