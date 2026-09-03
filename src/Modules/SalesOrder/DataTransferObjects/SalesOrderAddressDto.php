<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrder\DataTransferObjects;

readonly class SalesOrderAddressDto
{
    public function __construct(
        public ?string $company,
        public ?string $firstName,
        public ?string $lastName,
        public string $street,
        public ?string $postalCode,
        public ?string $city,
        public string $countryIso,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['company'] ?? null,
            $data['firstName'] ?? null,
            $data['lastName'] ?? null,
            $data['street'],
            $data['postalCode'] ?? null,
            $data['city'] ?? null,
            $data['countryIso'],
        );
    }
}
