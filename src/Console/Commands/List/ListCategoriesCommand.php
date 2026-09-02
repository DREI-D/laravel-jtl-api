<?php

namespace DREID\LaravelJtlApi\Console\Commands\List;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Helpers\CategoryHelper;
use DREID\LaravelJtlApi\Modules\Category\DataTransferObjects\CategoryDto;
use Illuminate\Console\Command;

class ListCategoriesCommand extends Command
{
    protected $signature = 'jtl-api:list:categories {parentId?}';
    protected $description = 'Lists the categories from JTL';

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     */
    public function handle(CategoryHelper $helper): void
    {
        $allCategories = $helper->loadAllCategories();

        $parentId = $this->argument('parentId');

        if ($parentId !== null) {
            $parentId = (int) $parentId;
        }

        $categories = array_filter($allCategories, function (CategoryDto $category) use ($parentId) {
            return $category->parentCategoryId === $parentId;
        });

        dd(array_values($categories));
    }
}
