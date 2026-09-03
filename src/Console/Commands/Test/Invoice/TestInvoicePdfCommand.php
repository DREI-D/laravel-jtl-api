<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\Invoice;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Info\InfoRepository;
use DREID\LaravelJtlApi\Modules\Invoice\InvoiceRepository;
use DREID\LaravelJtlApi\Modules\Invoice\Requests\PdfInvoiceRequest;
use Illuminate\Console\Command;

class TestInvoicePdfCommand extends Command
{
    protected $signature = 'jtl-api:test:invoice-pdf';

    protected $description = 'Tests the invoice pdf endpoint';

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
        dd(app(InvoiceRepository::class)->pdfInvoice(new PdfInvoiceRequest(invoiceId: 1)));
    }
}
