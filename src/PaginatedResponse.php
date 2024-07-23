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
        $this->totalItems = $this->response->json['TotalItems'];
        $this->pageNumber = $this->response->json['PageNumber'];
        $this->pageSize = $this->response->json['PageSize'];
        $this->totalPages = $this->response->json['TotalPages'];
        $this->hasPreviousPage = $this->response->json['HasPreviousPage'];
        $this->hasNextPage = $this->response->json['HasNextPage'];
        $this->nextPageNumber = $this->response->json['NextPageNumber'];
        $this->previousPageNumber = $this->response->json['PreviousPageNumber'];
    }
}
