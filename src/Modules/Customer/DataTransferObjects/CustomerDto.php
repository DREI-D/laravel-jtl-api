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
        public string $birthday,
        public bool $isLocked,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['id'],
            $data['number'],
            $data['customerGroupId'],
            static::parseAddress($data['billingAddress'] ?? null),
            static::parseAddress($data['shipmentaddress'] ?? null),
            static::parseAddress($data['customAddress'] ?? null),
            CustomerOtherAddressesDto::fromResponse($data['otherAddresses'] ?? []),
            $data['customerSince'],
            $data['lastChange'] ?? null,
            $data['languageIso'] ?? null,
            $data['internalCompanyId'],
            $data['customerCategoryId'] ?? null,
            $data['taxIdentificationNumber'] ?? null,
            $data['birthday'],
            $data['isLocked'],
        );
    }

    private static function parseAddress(?array $address): ?CustomerAddressDto
    {
        return $address ? CustomerAddressDto::fromResponse($address) : null;
    }
}
