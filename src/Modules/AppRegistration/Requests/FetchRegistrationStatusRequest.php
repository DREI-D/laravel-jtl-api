<?php

namespace DREID\LaravelJtlApi\Modules\AppRegistration\Requests;

readonly class FetchRegistrationStatusRequest
{
    public function __construct(
        public string $registrationId
    ) {}
}
