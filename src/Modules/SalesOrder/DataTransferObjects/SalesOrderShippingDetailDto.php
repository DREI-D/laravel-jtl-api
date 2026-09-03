<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrder\DataTransferObjects;

readonly class SalesOrderShippingDetailDto
{
    public function __construct(
        public ?int $shippingMethodId,
        public ?int $deliveryCompleteStatus,
        public ?int $shippingPriority,
        public ?string $shippingDate,
        public ?string $estimatedDeliveryDate,
        public ?string $deliveredDate,
        public ?int $onHoldReasonId,
        public ?float $extraWeight,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['shippingMethodId'] ?? null,
            $data['deliveryCompleteStatus'] ?? null,
            $data['shippingPriority'] ?? null,
            $data['shippingDate'] ?? null,
            $data['estimatedDeliveryDate'] ?? null,
            $data['deliveredDate'] ?? null,
            $data['onHoldReasonId'] ?? null,
            $data['extraWeight'] ?? null,
        );
    }
}
