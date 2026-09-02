<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\Customer;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Customer\CustomerRepository;
use DREID\LaravelJtlApi\Modules\Customer\DataTransferObjects\CustomerDto;
use DREID\LaravelJtlApi\Modules\Customer\Requests\QueryCustomersRequest;
use DREID\LaravelJtlApi\Modules\Customer\Requests\UpdateCustomerAddressRequest;
use DREID\LaravelJtlApi\Modules\Customer\Requests\UpdateCustomerRequest;
use Illuminate\Console\Command;
use Str;
use Throwable;

class TestCustomerUpdateCommand extends Command
{
    protected $signature = 'jtl-api:test:customer-update';

    protected $description = 'Tests the customer update endpoint';

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     * @throws Throwable
     */
    public function handle(): void
    {
        $response = app(CustomerRepository::class)->queryCustomers(new QueryCustomersRequest(pageSize: 1));
        throw_if($response->totalItems === 0);

        /** @var CustomerDto $customer */
        $customer = $response->items[0];

        $address = new UpdateCustomerAddressRequest(
            company: 'Drei-D Direktwerbung GmbH & Co. KG',
            company2: 'IT-Solutions',
            formOfAddress: 'Frau',
            title: 'Dr.',
            firstName: 'Maxime',
            lastName: 'Mustermann',
            street: 'Fuchsberger Damm 2',
            address2: 'Haupteingang',
            postalCode: '25335',
            city: 'Elmshorn',
            state: 'Schleswig-Holstein',
            countryIso: 'DE',
            vatId: 'DE 134 520 625',
            phoneNumber: '+49 4121 476-0',
            mobilePhoneNumber: '+49 4121 476-0',
            emailAddress: 'kontakt@dreid.de',
            fax: '+49 4121 476-147',
        );

        $response = app(CustomerRepository::class)->updateCustomer(
            new UpdateCustomerRequest(
                customerId: $customer->id,
                number: 'TEST-' . Str::random(),
                customerGroupId: $customer->customerGroupId,
                billingAddress: $address,
                shipmentAddress: $address,
                customerSince: now()->format('Y-m-d'),
                lastChange: now()->format('Y-m-d'),
                languageIso: 'DE',
                internalCompanyId: 1,
                customerCategoryId: null,
                taxIdentificationNumber: 'TEST',
                birthday: '2020-01-01',
                isLocked: false
            )
        );

        dd($response->customer);
    }
}
