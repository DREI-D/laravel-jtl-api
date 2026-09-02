<?php

namespace DREID\LaravelJtlApi\Modules\Customer\DataTransferObjects;

readonly class CustomerAddressDto
{
    public function __construct(
        public int $id,
        public ?string $company,
        public ?string $company2,
        public ?string $formOfAddress,
        public ?string $title,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $street,
        public ?string $address2,
        public ?string $postalCode,
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
            $data['id'],
            $data['company'] ?? null,
            $data['company2'] ?? null,
            $data['formOfAddress'] ?? null,
            $data['title'] ?? null,
            $data['firstName'] ?? null,
            $data['lastName'] ?? null,
            $data['street'] ?? null,
            $data['address2'] ?? null,
            $data['postalCode'] ?? null,
            $data['city'],
            $data['state'] ?? null,
            $data['countryIso'],
            $data['vatId'] ?? null,
            $data['phoneNumber'] ?? null,
            $data['mobilePhoneNumber'] ?? null,
            $data['emailAddress'] ?? null,
            $data['fax'] ?? null,
        );
    }
}
