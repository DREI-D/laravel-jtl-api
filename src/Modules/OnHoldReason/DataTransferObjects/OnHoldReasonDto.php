<?php

namespace DREID\LaravelJtlApi\Modules\OnHoldReason\DataTransferObjects;

readonly class OnHoldReasonDto
{
    public function __construct(
        public int $id,
        public string $name,
        public bool $IsMergeable,
        public bool $itemsNotUsedForPurchaseList,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Id'],
            $data['Name'],
            $data['IsMergeable'],
            $data['ItemsNotUsedForPurchaseList'],
        );
    }
}
