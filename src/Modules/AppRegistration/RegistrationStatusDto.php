<?php

namespace DREID\LaravelJtlApi\Modules\AppRegistration;

readonly class RegistrationStatusDto
{
    public function __construct(
        public string $appId,
        public string $registrationRequestId,
        public string $status,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['AppId'],
            $data['RegistrationRequestId'],
            $data['Status'],
        );
    }
}
