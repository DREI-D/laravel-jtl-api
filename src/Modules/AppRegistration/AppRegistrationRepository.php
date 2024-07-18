<?php

namespace DREID\LaravelJtlApi\Modules\AppRegistration;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\AppRegistration\Requests\FetchRegistrationStatusRequest;
use DREID\LaravelJtlApi\Modules\AppRegistration\Requests\RegisterAppRequest;
use DREID\LaravelJtlApi\Modules\AppRegistration\Responses\FetchRegistrationStatusResponse;
use DREID\LaravelJtlApi\Modules\AppRegistration\Responses\RegisterAppResponse;
use DREID\LaravelJtlApi\Repository;
use Http;

class AppRegistrationRepository extends Repository
{
    /**
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws MissingLicenseException
     * @throws ConnectionException
     */
    public function registerApp(RegisterAppRequest $request): RegisterAppResponse
    {
        $url = $this->parseUri('/v1/authentication');

        $body = [
            'AppId'                 => $request->appId,
            'DisplayName'           => $request->displayName,
            'Description'           => $request->description,
            'Version'               => $request->version,
            'ProviderName'          => $request->providerName,
            'ProviderWebsite'       => $request->providerWebsite,
            'MandatoryApiScopes'    => $request->mandatoryApiScopes,
            'AppIcon'               => $request->appIcon,
            'LocalizedDisplayNames' => $request->localizedDisplayNames,
            'LocalizedDescriptions' => $request->localizedDescriptions,
            'OptionalApiScopes'     => $request->optionalApiScopes,
            'RegistrationType'      => $request->registrationType,
        ];

        $headers = [
            'X-ChallengeCode' => config('jtl-api.challenge_code')
        ];

        try {
            $rawResponse = Http::withHeaders($headers)->post($url, $body);
        } catch (\Illuminate\Http\Client\ConnectionException $exception) {
            throw new ConnectionException($exception);
        }

        $response = ApiResponse::fromResponse(
            $rawResponse,
            $url,
            Repository::METHOD_POST,
            $body,
            $headers
        );

        if ($response->wasSuccessful) {
            return new RegisterAppResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }

    /**
     * @throws ConnectionException
     * @throws MissingLicenseException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     */
    public function fetchRegistrationStatus(FetchRegistrationStatusRequest $request): FetchRegistrationStatusResponse
    {
        $url = $this->parseUri('/v1/authentication/' . $request->registrationId);

        $headers = [
            'X-ChallengeCode' => config('jtl-api.challenge_code')
        ];

        try {
            $rawResponse = Http::withHeaders($headers)->get($url);
        } catch (\Illuminate\Http\Client\ConnectionException $exception) {
            throw new ConnectionException($exception);
        }

        $response = ApiResponse::fromResponse(
            $rawResponse,
            $url,
            Repository::METHOD_GET,
            [],
            $headers
        );

        if ($response->wasSuccessful) {
            return new FetchRegistrationStatusResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
