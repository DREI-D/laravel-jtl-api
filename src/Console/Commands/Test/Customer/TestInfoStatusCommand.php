<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\Customer;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Info\InfoRepository;
use Illuminate\Console\Command;

class TestInfoStatusCommand extends Command
{
    protected $signature = 'jtl-api:test:info-status';

    protected $description = 'Tests the info status endpoint';

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
        dd(app(InfoRepository::class)->getStatus()->info);
    }
}
