<?php

namespace DREID\LaravelJtlApi\Modules\CustomerGroup\DataTransferObjects;

readonly class CustomerGroupDto
{
    public function __construct(
        public int $id,
        public string $name,
        public bool $isDefault,
        public float $discount,
        public bool $isNetPrice,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Id'],
            $data['Name'],
            $data['IsDefault'],
            $data['Discount'],
            $data['IsNetPrice'],
        );
    }
}
