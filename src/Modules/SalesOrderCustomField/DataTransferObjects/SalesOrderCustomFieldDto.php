<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderCustomField\DataTransferObjects;

readonly class SalesOrderCustomFieldDto
{
    public function __construct(
        public int $customFieldId,
        public string $groupName,
        public string $name,
        public int $type,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['CustomFieldId'],
            $data['GroupName'],
            $data['Name'],
            $data['Type'],
        );
    }
}
