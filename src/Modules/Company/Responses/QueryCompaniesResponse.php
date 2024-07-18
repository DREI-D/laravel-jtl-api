<?php

namespace DREID\LaravelJtlApi\Modules\Company\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Company\CompanyDto;

readonly class QueryCompaniesResponse
{
    public array $companies;

    public function __construct(public ApiResponse $response)
    {
        $this->companies = array_map(static function ($item) {
            return CompanyDto::fromResponse($item);
        }, $this->response->json);
    }
}
