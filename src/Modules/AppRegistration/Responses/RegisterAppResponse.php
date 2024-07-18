<?php

namespace DREID\LaravelJtlApi\Modules\AppRegistration\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\AppRegistration\RegistrationStatusDto;
use DREID\LaravelJtlApi\Modules\Company\CompanyDto;

readonly class RegisterAppResponse
{
    public RegistrationStatusDto $registrationStatus;

    public function __construct(public ApiResponse $response)
    {
        $this->registrationStatus = RegistrationStatusDto::fromResponse($this->response->json);
    }
}
