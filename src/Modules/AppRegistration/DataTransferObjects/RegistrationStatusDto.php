<?php

namespace DREID\LaravelJtlApi\Modules\AppRegistration\DataTransferObjects;

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
            $data['appId'],
            $data['registrationRequestId'],
            $data['status'],
        );
    }
}
