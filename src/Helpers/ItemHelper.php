<?php

namespace DREID\LaravelJtlApi\Helpers;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Item\DataTransferObjects\ItemDto;
use DREID\LaravelJtlApi\Modules\Item\ItemRepository;
use DREID\LaravelJtlApi\Modules\Item\Requests\QueryItemsRequest;
use Str;

class ItemHelper
{
    /**
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     * @throws MissingLicenseException
     */
    public function findItemByNumber(string $number): ?ItemDto
    {
        $repository = app(ItemRepository::class);

        $response = $repository->queryItems(
            new QueryItemsRequest(
                searchKeyWord: $number,
            )
        );

        // multiple items beginning with the searched number and different casing can be returned by JTL.

        foreach ($response->items as $item) {
            /** @var ItemDto $item */

            if (Str::upper($item->sku) === Str::upper($number)) {
                return $item;
            }
        }

        return null;
    }
}
