<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrder\Requests;

readonly class QuerySalesOrdersRequest
{
    public function __construct(
        public ?string $salesOrderNumber = null,
        public ?string $externalOrderNumber = null,
        public ?string $billingNumber = null,
        public ?int $itemId = null,
        public ?int $customerId = null,
        public ?int $paymentStatus = null,
        public ?int $paymentMethodId = null,
        public ?int $deliveryCompleteStatus = null,
        public ?int $createdUserId = null,
        public ?int $companyId = null,
        public ?string $salesChannelId = null,
        public ?string $createdSince = null,
        public ?string $createdUntil = null,
        public ?int $colorId = null,
        public ?string $ebayUsername = null,
        public ?int $shippingMethodId = null,
        public ?string $deliveredDate = null,
        public ?bool $isCancelled = null,
        public ?int $onHoldReasonId = null,
        public ?bool $isExternalInvoice = null,
        public ?int $pageNumber = null,
        public ?int $pageSize = null,
    ) {}
}
