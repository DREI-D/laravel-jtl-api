<?php

namespace DREID\LaravelJtlApi\Modules\Item\DataTransferObjects;

readonly class ItemCategoryDto
{
    public function __construct(
        public int $categoryId,
        public string $name,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['CategoryId'],
            $data['Name'],
        );
    }
}
