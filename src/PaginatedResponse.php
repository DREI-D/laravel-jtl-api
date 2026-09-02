<?php

namespace DREID\LaravelJtlApi;

readonly class PaginatedResponse
{
    public int $totalItems;
    public int $pageNumber;
    public int $pageSize;
    public int $totalPages;
    public bool $hasPreviousPage;
    public bool $hasNextPage;
    public int $nextPageNumber;
    public int $previousPageNumber;

    public function __construct(
        public ApiResponse $response,
        public array $items
    ) {
        $this->totalItems = $this->response->json['totalItems'];
        $this->pageNumber = $this->response->json['pageNumber'];
        $this->pageSize = $this->response->json['pageSize'];
        $this->totalPages = $this->response->json['totalPages'];
        $this->hasPreviousPage = $this->response->json['hasPreviousPage'];
        $this->hasNextPage = $this->response->json['hasNextPage'];
        $this->nextPageNumber = $this->response->json['nextPageNumber'];
        $this->previousPageNumber = $this->response->json['previousPageNumber'];
    }
}
