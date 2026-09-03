<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\Category;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Category\CategoryRepository;
use DREID\LaravelJtlApi\Modules\Category\Requests\CreateCategoryRequest;
use Illuminate\Console\Command;
use Str;

class TestCategoryCreateCommand extends Command
{
    protected $signature = 'jtl-api:test:category-create';

    protected $description = 'Tests the category create endpoint';

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     */
    public function handle(): void
    {
        $response = app(CategoryRepository::class)->createCategory(
            new CreateCategoryRequest(
                name: 'Testkategorie ' . Str::random(),
                description: 'TEST',
                parentCategoryId: 0,
                sortNumber: 5,
                activeSalesChannels: []
            )
        );

        dd($response->category);
    }
}
