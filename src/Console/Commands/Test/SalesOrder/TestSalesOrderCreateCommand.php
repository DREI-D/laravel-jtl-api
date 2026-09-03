<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\SalesOrder;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Company\CompanyRepository;
use DREID\LaravelJtlApi\Modules\Company\DataTransferObjects\CompanyDto;
use DREID\LaravelJtlApi\Modules\Customer\CustomerRepository;
use DREID\LaravelJtlApi\Modules\Customer\DataTransferObjects\CustomerDto;
use DREID\LaravelJtlApi\Modules\Customer\Requests\QueryCustomersRequest;
use DREID\LaravelJtlApi\Modules\SalesOrder\Requests\CreateSalesOrderAddressRequest;
use DREID\LaravelJtlApi\Modules\SalesOrder\Requests\CreateSalesOrderDepartureCountryRequest;
use DREID\LaravelJtlApi\Modules\SalesOrder\Requests\CreateSalesOrderRequest;
use DREID\LaravelJtlApi\Modules\SalesOrder\Requests\CreateSalesOrderShippingDetailRequest;
use DREID\LaravelJtlApi\Modules\SalesOrder\SalesOrderRepository;
use DREID\LaravelJtlApi\Modules\ShippingMethod\DataTransferObjects\ShippingMethodDto;
use DREID\LaravelJtlApi\Modules\ShippingMethod\ShippingMethodRepository;
use Illuminate\Console\Command;
use Str;
use Throwable;

class TestSalesOrderCreateCommand extends Command
{
    protected $signature = 'jtl-api:test:sales-order-create';

    protected $description = 'Tests the sales order create endpoint';

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

        $response = app(CompanyRepository::class)->queryCompanies();
        throw_if(count($response->companies) === 0);

        /** @var CompanyDto $company */
        $company = $response->companies[0];

        $response = app(ShippingMethodRepository::class)->queryShippingMethods();
        throw_if(count($response->shippingMethods) === 0);

        /** @var ShippingMethodDto $shippingMethod */
        $shippingMethod = $response->shippingMethods[0];

        $address = new CreateSalesOrderAddressRequest(
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

        $response = app(SalesOrderRepository::class)->createSalesOrder(
            new CreateSalesOrderRequest(
                customerId: $customer->id,
                number: 'TEST-' . Str::random(),
                externalNumber: 'EXT-' . Str::random(),
                companyId: $company->id,
                departureCountry: new CreateSalesOrderDepartureCountryRequest(
                    countryIso: 'DE',
                    state: 'SH',
                    currencyIso: 'EUR',
                    currencyFactor: 1
                ),
                customerVatId: 'TEST customerVatId',
                billingAddress: $address,
                shipmentAddress: $address,
                salesOrderDate: '2026-01-05',
                salesOrderShippingDetail: new CreateSalesOrderShippingDetailRequest(
                    shippingMethodId: $shippingMethod->id,
                    shippingPriority: 5,
                    shippingDate: now()->addDay()->format('Y-m-d'),
                    estimatedDeliveryDate: now()->addDays(3)->format('Y-m-d'),
                    onHoldReasonId: null,
                    extraWeight: 1,
                ),
                colorCodeId: null,
                comment: 'TEST comment',
                customerComment: 'TEST customerComment',
                languageIso: 'DE'
            )
        );

        dd($response->salesOrder);
    }
}
