<?php

namespace DREID\LaravelJtlApi\Console\Commands\List;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\ShippingMethod\ShippingMethodRepository;
use Illuminate\Console\Command;

class ListShippingMethodsCommand extends Command
{
    protected $signature = 'jtl-api:list:shipping-methods';
    protected $description = 'Lists the shipping methods from JTL';

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     */
    public function handle(ShippingMethodRepository $repository): void
    {
        dd($repository->queryShippingMethods()->shippingMethods);
    }
}
