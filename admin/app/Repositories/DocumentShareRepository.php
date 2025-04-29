<?php

namespace App\Repositories;

use App\Models\DocumentShare;

class DocumentShareRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = DocumentShare::class;
    }

    public function model()
    {
        return $this->model;
    }

    public function list(string $status = 'approve')
    {
        return DocumentShare::where('status', $status)
            ->orderByDesc("id")->get();
    }

}
