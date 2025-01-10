<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrder\DataTransferObjects;

readonly class SalesOrderDto
{
    public function __construct(
        public int $id,
        public string $number,
        public ?string $externalNumber,
        public ?string $billingNumber,
        public int $companyId,
        public SalesOrderDepartureCountryDto $departureCountry,
        public SalesOrderAddressDto $billingAddress,
        public SalesOrderAddressDto $shipmentAddress,
        public ?int $customerId,
        public ?string $customerVatId,
        public ?string $merchantVatId,
        public ?string $salesOrderDate,
        public SalesOrderShippingDetailDto $salesOrderShippingDetail,
        public ?int $colorCodeId,
        public ?bool $isExternalInvoice,
        public ?string $comment,
        public ?string $customerComment,
        public ?bool $isCancelled,
        public ?string $languageIso,
        public ?string $salesChannelId,
        public ?int $userCreatedId,
        public ?int $userId,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Id'],
            $data['Number'],
            $data['ExternalNumber'],
            $data['BillingNumber'] ?? null,
            $data['CompanyId'],
            SalesOrderDepartureCountryDto::fromResponse($data['DepartureCountry']),
            SalesOrderAddressDto::fromResponse($data['BillingAddress']),
            SalesOrderAddressDto::fromResponse($data['Shipmentaddress']),
            $data['CustomerId'] ?? null,
            $data['CustomerVatID'] ?? null,
            $data['MerchantVatID'] ?? null,
            $data['SalesOrderDate'],
            SalesOrderShippingDetailDto::fromResponse($data['SalesOrderShippingDetail']),
            $data['ColorcodeId'] ?? null,
            $data['IsExternalInvoice'] ?? null,
            $data['Comment'] ?? null,
            $data['CustomerComment'] ?? null,
            $data['IsCancelled'] ?? null,
            $data['LanguageIso'],
            $data['SalesChannelId'] ?? null,
            $data['UserCreatedId'] ?? null,
            $data['UserId'] ?? null,
        );
    }
}
