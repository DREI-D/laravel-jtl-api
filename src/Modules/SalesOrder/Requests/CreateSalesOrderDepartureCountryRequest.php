<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrder\Requests;

readonly class CreateSalesOrderDepartureCountryRequest
{
    public function __construct(
        public ?string $countryIso = null,
        public ?string $state = null,
        public ?string $currencyIso = null,
        public ?float $currencyFactor = null,
    ) {}
}
