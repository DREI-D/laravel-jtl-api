<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrder\Requests;

readonly class CreateSalesOrderAddressRequest
{
    public function __construct(
        public string $city,
        public string $countryIso,
        public ?string $company = null,
        public ?string $company2 = null,
        public ?string $formOfAddress = null,
        public ?string $title = null,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $street = null,
        public ?string $address2 = null,
        public ?string $postalCode = null,
        public ?string $state = null,
        public ?string $vatId = null,
        public ?string $phoneNumber = null,
        public ?string $mobilePhoneNumber = null,
        public ?string $emailAddress = null,
        public ?string $fax = null,
    ) {}
}
