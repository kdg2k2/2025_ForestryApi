<?php

namespace App\Services;

use App\Repositories\DocumentShareRepository;

class DocumentShareService extends BaseService
{
    protected $documentShareRepository;
    public function __construct()
    {
        $this->documentShareRepository = app(DocumentShareRepository::class);
    }

    public function list(array $request, string $status = 'approve')
    {
        return $this->tryThrow(function () use ($request, $status) {
            $records = $this->documentShareRepository->list($status);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

}
