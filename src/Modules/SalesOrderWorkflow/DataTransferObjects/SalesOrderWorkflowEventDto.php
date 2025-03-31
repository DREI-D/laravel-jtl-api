<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderWorkflow\DataTransferObjects;

readonly class SalesOrderWorkflowEventDto
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
