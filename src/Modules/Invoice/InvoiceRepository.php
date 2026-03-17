<?php

namespace DREID\LaravelJtlApi\Modules\Invoice;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Invoice\Requests\PdfInvoiceRequest;
use DREID\LaravelJtlApi\Modules\Invoice\Responses\PdfInvoiceResponse;
use DREID\LaravelJtlApi\Repository;

class InvoiceRepository extends Repository
{
    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingPermissionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     */
    public function pdfInvoice(PdfInvoiceRequest $request): PdfInvoiceResponse
    {
        $permissions = [Permission::InvoicesRead, Permission::InvoicesPdf];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->post('/v1/invoices/' . $request->invoiceId . '/output/pdf');

        if ($response->wasSuccessful) {
            return new PdfInvoiceResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
