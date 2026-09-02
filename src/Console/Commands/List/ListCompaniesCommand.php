<?php

namespace DREID\LaravelJtlApi\Console\Commands\List;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Company\CompanyRepository;
use Illuminate\Console\Command;

class ListCompaniesCommand extends Command
{
    protected $signature = 'jtl-api:list:companies';
    protected $description = 'Lists the companies from JTL';

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     */
    public function handle(CompanyRepository $repository): void
    {
        dd($repository->queryCompanies()->companies);
    }
}
