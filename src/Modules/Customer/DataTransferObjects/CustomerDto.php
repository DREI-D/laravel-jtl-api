<?php

namespace DREID\LaravelJtlApi\Modules\Customer\DataTransferObjects;

readonly class CustomerDto
{
    public function __construct(
        public int $id,
        public string $number,
        public int $customerGroupId,
        public ?CustomerAddressDto $billingAddress,
        public ?CustomerAddressDto $shippingAddress,
        public ?CustomerAddressDto $customAddress,
        public ?CustomerOtherAddressesDto $otherAddresses,
        public string $customerSince,
        public ?string $lastChange,
        public ?string $languageIso,
        public int $internalCompanyId,
        public ?int $customerCategoryId,
        public ?string $taxIdentificationNumber,
        public ?string $accountReceivableNumber,
        public ?string $commercialRegisterNumber,
        public ?string $website,
        public ?string $initialContact,
        public ?string $ebayUsername,
        public string $birthday,
        public bool $isLocked,
        public bool $isCashRegisterBased,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Id'],
            $data['Number'],
            $data['CustomerGroupId'],
            static::parseAddress($data['BillingAddress'] ?? null),
            static::parseAddress($data['ShippingAddress'] ?? null),
            static::parseAddress($data['CustomAddress'] ?? null),
            CustomerOtherAddressesDto::fromResponse($data['OtherAddresses'] ?? []),
            $data['CustomerSince'],
            $data['LastChange'] ?? null,
            $data['LanguageIso'] ?? null,
            $data['InternalCompanyId'],
            $data['CustomerCategoryId'] ?? null,
            $data['TaxIdentificationNumber'] ?? null,
            $data['AccountReceivableNumber'] ?? null,
            $data['CommercialRegisterNumber'] ?? null,
            $data['Website'] ?? null,
            $data['InitialContact'] ?? null,
            $data['EbayUsername'] ?? null,
            $data['Birthday'],
            $data['IsLocked'],
            $data['IsCashRegisterBased'],
        );
    }

    private static function parseAddress(?array $address): ?CustomerAddressDto
    {
        return $address ? CustomerAddressDto::fromResponse($address) : null;
    }
}
