<?php

namespace DREID\LaravelJtlApi\Modules\Info\DataTransferObjects;

use DREID\LaravelJtlApi\Services\DataTransferObjectService;
use Illuminate\Support\Carbon;

readonly class InfoDto
{
    public function __construct(
        public string $version,
        public Carbon $timestamp,
        public string $tenant,
        public string $type,
    ) {}

    public static function fromResponse(array $data): static
    {
        $service = app(DataTransferObjectService::class);

        return new self(
            $data['Version'],
            $service->getDateValue($data, 'Timestamp'),
            $data['Tenant'],
            $data['Type'],
        );
    }
}
