<?php

namespace DREID\LaravelJtlApi\Modules\Category;

readonly class CategoryDto
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $description,
        public ?int $parentCategoryId,
        public int $level,
        public int $sortNumber,
        public array $activeSalesChannels,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Id'],
            $data['Name'],
            $data['Description'] ?: null,
            $data['ParentCategoryId'] ?? null,
            $data['Level'],
            $data['SortNumber'],
            $data['ActiveSalesChannels'],
        );
    }
}
