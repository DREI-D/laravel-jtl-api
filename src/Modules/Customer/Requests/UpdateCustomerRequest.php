<?php

namespace DREID\LaravelJtlApi\Modules\Customer\Requests;

readonly class UpdateCustomerRequest
{
    public function __construct(
        public int $customerId,
        public ?string $number = null,
        public ?int $customerGroupId = null,
        public ?UpdateCustomerAddressRequest $billingAddress = null,
        public ?UpdateCustomerAddressRequest $shipmentAddress = null,
        public ?UpdateCustomerAddressRequest $customAddress = null,
        public ?string $customerSince = null,
        public ?string $lastChange = null,
        public ?string $languageIso = null,
        public ?int $internalCompanyId = null,
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
