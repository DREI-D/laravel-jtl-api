<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrder\DataTransferObjects;

readonly class SalesOrderDto
{
    public function __construct(
        public int $id,
        public string $number,
        public ?string $externalNumber,
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
            $data['id'],
            $data['number'],
            $data['externalNumber'],
            $data['companyId'],
            SalesOrderDepartureCountryDto::fromResponse($data['departureCountry']),
            SalesOrderAddressDto::fromResponse($data['billingAddress']),
            SalesOrderAddressDto::fromResponse($data['shipmentaddress']),
            $data['customerId'] ?? null,
            $data['customerVatID'] ?? null,
            $data['merchantVatID'] ?? null,
            $data['salesOrderDate'],
            SalesOrderShippingDetailDto::fromResponse($data['salesOrderShippingDetail']),
            $data['colorcodeId'] ?? null,
            $data['isExternalInvoice'] ?? null,
            $data['comment'] ?? null,
            $data['customerComment'] ?? null,
            $data['isCancelled'] ?? null,
            $data['languageIso'],
            $data['salesChannelId'] ?? null,
            $data['userCreatedId'] ?? null,
            $data['userId'] ?? null,
        );
    }
}
