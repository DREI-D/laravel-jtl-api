<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrder\Requests;

readonly class CreateSalesOrderRequest
{
    public function __construct(
        public int $customerId,
        public ?string $number = null,
        public ?string $externalNumber = null,
        public ?string $billingNumber = null,
        public ?int $companyId = null,
        public ?CreateSalesOrderDepartureCountryRequest $departureCountry = null,
        public ?string $customerVatId = null,
        public ?CreateSalesOrderAddressRequest $billingAddress = null,
        public ?CreateSalesOrderAddressRequest $shipmentAddress = null,
        public ?string $salesOrderDate = null,
        public ?int $colorCodeId = null,
        public ?string $comment = null,
        public ?string $customerComment = null,
        public ?string $languageIso = null,
    ) {}
}
