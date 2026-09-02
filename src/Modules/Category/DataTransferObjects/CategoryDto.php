<?php

namespace DREID\LaravelJtlApi\Modules\Category\DataTransferObjects;

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
            $data['id'],
            $data['name'],
            $data['description'] ?: null,
            $data['parentCategoryId'] ?? null,
            $data['level'],
            $data['sortNumber'],
            $data['activeSalesChannels'],
        );
    }
}
