<?php

namespace DREID\LaravelJtlApi\Modules\Item\DataTransferObjects;

readonly class ItemPriceDataDto
{
    public function __construct(
        public float $salesPriceNet,
        public float $suggestedRetailPrice,
        public float $purchasePriceNet,
        public float $ebayPrice,
        public float $amazonPrice,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['SalesPriceNet'],
            $data['SuggestedRetailPrice'],
            $data['PurchasePriceNet'],
            $data['EbayPrice'],
            $data['AmazonPrice'],
        );
    }
}
