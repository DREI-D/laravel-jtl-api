<?php

namespace DREID\LaravelJtlApi\Modules\Item;

readonly class ItemDto
{
    public function __construct(
        public int $id,
        public string $sku,
        public string $name,
        public ?string $description,
        public ?string $shortDescription,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Id'],
            $data['SKU'],
            $data['Name'],
            $data['Description'] ?: null,
            $data['ShortDescription'] ?: null,
        );
    }
}
