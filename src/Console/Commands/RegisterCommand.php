<?php

namespace DREID\LaravelJtlApi\Console\Commands;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Helpers\AppRegistrationHelper;
use Illuminate\Console\Command;

class RegisterCommand extends Command
{
    protected $signature = 'jtl-api:register';
    protected $description = 'Registers the connector in JTL';

    /**
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     * @throws MissingLicenseException
     */
    public function handle(AppRegistrationHelper $helper): void
    {
        $token = $helper->register();

        $this->line("Retrieved api token:");
        $this->info($token->apiKey);
    }
}
