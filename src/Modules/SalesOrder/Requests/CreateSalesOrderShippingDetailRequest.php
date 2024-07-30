<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrder\Requests;

readonly class CreateSalesOrderShippingDetailRequest
{
    public function __construct(
        public ?int $shippingMethodId = null,
        public ?int $shippingPriority = null,
        public ?string $shippingDate = null,
        public ?string $estimatedDeliveryDate = null,
        public ?int $onHoldReasonId = null,
        public ?float $extraWeight = null,
    ) {}
}
