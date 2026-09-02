<?php

namespace DREID\LaravelJtlApi\Modules\Customer\DataTransferObjects;

readonly class CustomerOtherAddressesDto
{
    public function __construct(
        public array $otherBillingAddresses,
        public array $otherShippingAddresses,
        public array $otherCustomerAddresses,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            array_map(fn ($item) => CustomerAddressDto::fromResponse($item), $data['otherBillingAddresses'] ?? []),
            array_map(fn ($item) => CustomerAddressDto::fromResponse($item), $data['otherShippingAddresses'] ?? []),
            array_map(fn ($item) => CustomerAddressDto::fromResponse($item), $data['otherCustomerAddresses'] ?? []),
        );
    }
}
