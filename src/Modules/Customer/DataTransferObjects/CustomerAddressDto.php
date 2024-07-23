<?php

namespace DREID\LaravelJtlApi\Modules\Customer\DataTransferObjects;

readonly class CustomerAddressDto
{
    public function __construct(
        public int $id,
        public string $company,
        public ?string $company2,
        public ?string $formOfAddress,
        public ?string $title,
        public ?string $firstName,
        public ?string $lastName,
        public string $street,
        public ?string $address2,
        public string $postalCode,
        public string $city,
        public ?string $state,
        public string $countryIso,
        public ?string $vatId,
        public ?string $phoneNumber,
        public ?string $mobilePhoneNumber,
        public ?string $emailAddress,
        public ?string $fax,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Id'],
            $data['Company'],
            $data['Company2'] ?? null,
            $data['FormOfAddress']  ?? null,
            $data['Title'] ?? null,
            $data['FirstName'] ?? null,
            $data['LastName'] ?? null,
            $data['Street'],
            $data['Address2'] ?? null,
            $data['PostalCode'],
            $data['City'],
            $data['State'] ?? null,
            $data['CountryIso'],
            $data['VatId'] ?? null,
            $data['PhoneNumber'] ?? null,
            $data['MobilePhoneNumber'] ?? null,
            $data['EmailAddress'] ?? null,
            $data['Fax'] ?? null,
        );
    }
}
