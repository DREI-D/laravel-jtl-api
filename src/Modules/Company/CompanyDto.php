<?php

namespace DREID\LaravelJtlApi\Modules\Company;

readonly class CompanyDto
{
    public function __construct(
        public int $id,
        public string $name,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Id'],
            $data['Name'],
        );
    }
}
