<?php

namespace DREID\LaravelJtlApi\Modules\Info\DataTransferObjects;

use DREID\LaravelJtlApi\Modules\Item\DataTransferObjects\ItemDangerousGoodsDto;
use DREID\LaravelJtlApi\Modules\Item\DataTransferObjects\ItemDimensionsDto;
use DREID\LaravelJtlApi\Modules\Item\DataTransferObjects\ItemIdentifiersDto;
use DREID\LaravelJtlApi\Modules\Item\DataTransferObjects\ItemPriceDataDto;
use DREID\LaravelJtlApi\Modules\Item\DataTransferObjects\ItemStorageOptionsDto;
use DREID\LaravelJtlApi\Modules\Item\DataTransferObjects\ItemWeightsDto;
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
