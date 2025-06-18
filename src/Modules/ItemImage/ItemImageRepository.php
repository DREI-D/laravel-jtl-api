<?php

namespace DREID\LaravelJtlApi\Modules\ItemImage;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\ItemImage\Requests\QueryItemImageDataRequest;
use DREID\LaravelJtlApi\Modules\ItemImage\Requests\QueryItemImagesRequest;
use DREID\LaravelJtlApi\Modules\ItemImage\Responses\QueryItemImageDataResponse;
use DREID\LaravelJtlApi\Modules\ItemImage\Responses\QueryItemImagesResponse;
use DREID\LaravelJtlApi\Repository;

class ItemImageRepository extends Repository
{
    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function queryItemImages(QueryItemImagesRequest $request): QueryItemImagesResponse
    {
        $permissions = [Permission::AllRead, Permission::QueryItemImages];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/items/' . $request->itemId . '/images');

        if ($response->wasSuccessful) {
            return new QueryItemImagesResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingPermissionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     */
    public function queryItemImageData(QueryItemImageDataRequest $request): QueryItemImageDataResponse
    {
        $permissions = [Permission::AllRead, Permission::QueryItemImageData];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/items/imagedata/' . $request->imageId);

        if ($response->wasSuccessful) {
            return new QueryItemImageDataResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
