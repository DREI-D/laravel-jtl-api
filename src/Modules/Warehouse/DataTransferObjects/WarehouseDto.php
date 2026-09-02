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
            $data['id'],
            $data['name'],
            $data['code'] ?? null,
            $data['description'] ?? null,
            $data['priority'] ?? null,
            $data['companyId'] ?? null,
            $data['lockForShipment'],
            $data['lockForAvailability'],
            $data['isActive'],
        );
    }
}
