<?php

namespace DREID\LaravelJtlApi\Console\Commands\List;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\SalesOrderCustomField\SalesOrderCustomFieldRepository;
use Illuminate\Console\Command;

class ListSalesOrderCustomFieldsCommand extends Command
{
    protected $signature = 'jtl-api:list:sales-order-custom-fields';
    protected $description = 'Lists the sales order custom fields from JTL';

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     */
    public function handle(SalesOrderCustomFieldRepository $repository): void
    {
        dd($repository->querySalesOrderCustomFields()->customFields);
    }
}
