<?php

namespace DREID\LaravelJtlApi\Modules\ItemImage;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\ItemImage\Requests\CreateItemImageRequest;
use DREID\LaravelJtlApi\Modules\ItemImage\Requests\DeleteItemImageRequest;
use DREID\LaravelJtlApi\Modules\ItemImage\Requests\QueryItemImageDataRequest;
use DREID\LaravelJtlApi\Modules\ItemImage\Requests\QueryItemImagesRequest;
use DREID\LaravelJtlApi\Modules\ItemImage\Responses\CreateItemImageResponse;
use DREID\LaravelJtlApi\Modules\ItemImage\Responses\DeleteItemImageResponse;
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

        $response = $this->get('/v1/items/' . $request->itemId . '/images');

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

        $response = $this->get('/v1/items/imagedata/' . $request->imageId);

        if ($response->wasSuccessful) {
            return new QueryItemImageDataResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     * @throws MissingLicenseException
     */
    public function createItemImage(CreateItemImageRequest $request): CreateItemImageResponse
    {
        $permissions = [Permission::CreateItemImage];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->post('/v1/items/' . $request->itemId . '/images', [
            'ImageData'      => $request->imageData,
            'Filename'       => $request->filename,
            'SalesChannelId' => $request->salesChannelId
        ]);

        if ($response->wasSuccessful) {
            return new CreateItemImageResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     * @throws MissingLicenseException
     */
    public function deleteItemImage(DeleteItemImageRequest $request): DeleteItemImageResponse
    {
        $permissions = [Permission::DeleteItemImage];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->delete('/v1/items/' . $request->itemId . '/images/' . $request->imageId);

        if ($response->wasSuccessful) {
            return new DeleteItemImageResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
