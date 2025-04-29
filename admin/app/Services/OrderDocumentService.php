<?php

namespace App\Services;

use App\Repositories\OrderDocumentRepository;

class OrderDocumentService extends BaseService
{
    protected $orderDocumentRepository;
    public function __construct()
    {
        $this->orderDocumentRepository = app(OrderDocumentRepository::class);
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->orderDocumentRepository->store($request);
        });
    }
}
