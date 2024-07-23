<?php

namespace DREID\LaravelJtlApi\Modules\Customer\Requests;

readonly class CreateCustomerRequest
{
    public function __construct(
        public int $customerGroupId,
        public int $internalCompanyId,
        public string $languageIso,
        public CreateCustomerAddressRequest $billingAddress,
        public ?CreateCustomerAddressRequest $shipmentAddress = null,
        public ?CreateCustomerAddressRequest $customAddress = null,
        public ?string $number = null,
        public ?string $customerSince = null,
        public ?string $lastChange = null,
        public ?int $customerCategoryId = null,
        public ?string $taxIdentificationNumber = null,
        public ?string $accountsReceivableNumber = null,
        public ?string $commercialRegisterNumber = null,
        public ?string $website = null,
        public ?string $initialContact = null,
        public ?string $ebayUsername = null,
        public ?string $birthday = null,
        public ?bool $isLocked = null,
        public ?bool $isCashRegisterBased = null,
    ) {}
}
