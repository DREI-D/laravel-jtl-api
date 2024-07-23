<?php

namespace DREID\LaravelJtlApi\Modules\AppRegistration\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\AppRegistration\DataTransferObjects\RegistrationStatusDto;
use DREID\LaravelJtlApi\Modules\AppRegistration\DataTransferObjects\TokenDto;

readonly class FetchRegistrationStatusResponse
{
    public RegistrationStatusDto $requestStatusInfo;
    public ?TokenDto $token;

    public function __construct(public ApiResponse $response)
    {
        $this->requestStatusInfo = RegistrationStatusDto::fromResponse($this->response->json['RequestStatusInfo']);

        $this->token = isset($this->response->json['Token'])
            ? TokenDto::fromResponse($this->response->json['Token'])
            : null;
    }
}
