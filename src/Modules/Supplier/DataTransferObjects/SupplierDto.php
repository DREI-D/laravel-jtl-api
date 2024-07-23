<?php

namespace DREID\LaravelJtlApi\Modules\Supplier\DataTransferObjects;

readonly class SupplierDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $type,
        public ?string $supplierNo = null,
        public ?string $internalCustomerId = null,
        public ?string $languageIso = null,
        public ?string $formOfAddress = null,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $company = null,
        public ?string $company2 = null,
        public ?string $contact = null,
        public ?string $street = null,
        public ?string $address2 = null,
        public ?string $postalCode = null,
        public ?string $city = null,
        public ?string $state = null,
        public ?string $countryIso = null,
        public ?string $phone = null,
        public ?string $phoneExtension = null,
        public ?string $fax = null,
        public ?string $email = null,
        public ?string $website = null,
        public ?string $comment = null,
        public ?string $vatId = null,
        public ?string $status = null,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Id'],
            $data['Name'],
            $data['Type'],
            $data['SupplierNo'] ?? null,
            $data['InternalCustomerId'] ?? null,
            $data['LanguageISO'] ?? null,
            $data['FormOfAddress'] ?? null,
            $data['FirstName'] ?? null,
            $data['LastName'] ?? null,
            $data['Company'] ?? null,
            $data['Company2'] ?? null,
            $data['Contact'] ?? null,
            $data['Street'] ?? null,
            $data['Address2'] ?? null,
            $data['PostalCode'] ?? null,
            $data['City'] ?? null,
            $data['State'] ?? null,
            $data['CountryIso'] ?? null,
            $data['Phone'] ?? null,
            $data['PhoneExtension'] ?? null,
            $data['Fax'] ?? null,
            $data['Email'] ?? null,
            $data['Website'] ?? null,
            $data['Comment'] ?? null,
            $data['VatID'] ?? null,
            $data['Status'] ?? null,
        );
    }
}
