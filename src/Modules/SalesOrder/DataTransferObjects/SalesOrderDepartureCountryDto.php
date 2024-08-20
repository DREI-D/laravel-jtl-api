<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrder\DataTransferObjects;

readonly class SalesOrderDepartureCountryDto
{
    public function __construct(
        public string $countryIso,
        public string $currencyIso,
        public float $currencyFactor,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['CountryISO'],
            $data['CurrencyIso'],
            $data['CurrencyFactor'],
        );
    }
}
