<?php

namespace DREID\LaravelJtlApi\Modules\Warehouse\DataTransferObjects;

readonly class WarehouseDto
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $code,
        public ?string $description,
        public ?int $priority,
        public ?int $companyId,
        public bool $lockForShipment,
        public bool $lockForAvailability,
        public bool $isActive,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Id'],
            $data['Name'],
            $data['Code'] ?? null,
            $data['Description'] ?? null,
            $data['Priority'] ?? null,
            $data['CompanyId'] ?? null,
            $data['LockForShipment'],
            $data['LockForAvailability'],
            $data['IsActive'],
        );
    }
}
