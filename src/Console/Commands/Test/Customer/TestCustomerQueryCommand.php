<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\Customer;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Customer\CustomerRepository;
use DREID\LaravelJtlApi\Modules\Customer\Requests\QueryCustomersRequest;
use Illuminate\Console\Command;

class TestCustomerQueryCommand extends Command
{
    protected $signature = 'jtl-api:test:customer-query';

    protected $description = 'Tests the customer query endpoint';

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
        $response = app(CustomerRepository::class)->queryCustomers(new QueryCustomersRequest());

        dd($response);
    }
}
