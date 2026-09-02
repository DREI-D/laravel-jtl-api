<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\Customer;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Customer\CustomerRepository;
use DREID\LaravelJtlApi\Modules\Customer\Requests\CreateCustomerAddressRequest;
use DREID\LaravelJtlApi\Modules\Customer\Requests\CreateCustomerRequest;
use Illuminate\Console\Command;

class TestCustomerCreateCommand extends Command
{
    protected $signature = 'jtl-api:test:customer-create';

    protected $description = 'Tests the customer create endpoint';

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
        $address = new CreateCustomerAddressRequest(
            city: 'Elmshorn',
            countryIso: 'DE',
            company: 'Drei-D Direktwerbung GmbH & Co. KG',
            company2: 'IT-Solutions',
            formOfAddress: 'Herr',
            title: 'Dr.',
            firstName: 'Max',
            lastName: 'Mustermann',
            street: 'Fuchsberger Damm 2',
            address2: 'Haupteingang',
            postalCode: '25335',
            state: 'Schleswig-Holstein',
            vatId: 'DE 134 520 625',
            phoneNumber: '+49 4121 476-0',
            mobilePhoneNumber: '+49 4121 476-0',
            emailAddress: 'kontakt@dreid.de',
            fax: '+49 4121 476-147',
        );

        $response = app(CustomerRepository::class)->createCustomer(
            new CreateCustomerRequest(
                customerGroupId: 1,
                internalCompanyId: 1,
                languageIso: 'DE',
                billingAddress: $address,
                shipmentAddress: $address,
                number: 'TEST',
                customerSince: now()->format('Y-m-d'),
                lastChange: now()->format('Y-m-d'),
                customerCategoryId: null,
                taxIdentificationNumber: 'TEST',
                birthday: '2020-01-01',
                isLocked: false
            )
        );

        dd($response->customer);
    }
}
