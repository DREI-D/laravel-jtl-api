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
            $data['ShippingMethodId'] ?? null,
            $data['DeliveryCompleteStatus'] ?? null,
            $data['ShippingPriority'] ?? null,
            $data['ShippingDate'] ?? null,
            $data['EstimatedDeliveryDate'] ?? null,
            $data['DeliveredDate'] ?? null,
            $data['OnHoldReasonId'] ?? null,
            $data['ExtraWeight'] ?? null,
        );
    }
}
