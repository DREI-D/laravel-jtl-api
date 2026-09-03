<?php

namespace DREID\LaravelJtlApi\Modules\Category\Requests;

readonly class CreateCategoryRequest
{
    public function __construct(
        public string $name,
        public ?string $description = null,
        public ?int $parentCategoryId = null,
        public ?int $sortNumber = null,
        public ?array $activeSalesChannels = null,
    ) {}
}
