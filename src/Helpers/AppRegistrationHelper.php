<?php

namespace DREID\LaravelJtlApi\Helpers;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\AppRegistration\AppRegistrationRepository;
use DREID\LaravelJtlApi\Modules\AppRegistration\DataTransferObjects\TokenDto;
use DREID\LaravelJtlApi\Modules\AppRegistration\Requests\FetchRegistrationStatusRequest;
use DREID\LaravelJtlApi\Modules\AppRegistration\Requests\RegisterAppRequest;

class AppRegistrationHelper
{
    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingLicenseException
     */
    public function register(): TokenDto
    {
        $repository = app(AppRegistrationRepository::class);

        $response = $repository->registerApp(new RegisterAppRequest(
            config('jtl-api.app_id'),
            config('jtl-api.display_name'),
            config('jtl-api.description'),
            config('jtl-api.version'),
            config('jtl-api.provider_name'),
            config('jtl-api.provider_website'),
            config('jtl-api.permissions'),
            base64_encode(file_get_contents(config('jtl-api.app_icon'))),
            registrationType: config('jtl-api.registration_type')
        ));

        $id = $response->registrationStatus->registrationRequestId;

        while (true) {
            $response = $repository->fetchRegistrationStatus(new FetchRegistrationStatusRequest(
                $id
            ));

            if ($response->token) {
                break;
            }

            sleep(5);
        }

        return $response->token;
    }
}
