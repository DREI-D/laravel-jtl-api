<?php

namespace DREID\LaravelJtlApi\Modules\AppRegistration\Requests;

readonly class RegisterAppRequest
{
    public function __construct(
        public string $appId,
        public string $displayName,
        public string $description,
        public string $version,
        public string $providerName,
        public string $providerWebsite,
        public array $mandatoryApiScopes,
        public string $appIcon,
        public array $localizedDisplayNames = [],
        public array $localizedDescriptions = [],
        public array $optionalApiScopes = [],
        public int $registrationType = 0
    ) {}
}
