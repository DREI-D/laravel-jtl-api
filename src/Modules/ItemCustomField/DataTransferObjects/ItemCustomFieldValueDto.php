<?php

namespace DREID\LaravelJtlApi\Modules\ItemCustomField\DataTransferObjects;

use DREID\LaravelJtlApi\Services\DataTransferObjectService;

readonly class ItemCustomFieldValueDto
{
    public function __construct(
        public int $customFieldId,
        public mixed $value,
    ) {}

    public static function fromResponse(array $data): static
    {
        $service = app(DataTransferObjectService::class);

        return new self(
            $data['CustomFieldId'],
            $service->getArrayValue($data, 'Value'),
        );
    }
}
