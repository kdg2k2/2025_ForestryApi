<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DocumentShareService;
use App\Services\DocumentTypeService;
use App\Services\UserService;

class DocumentController extends Controller
{
    protected $documentTypeService;
    protected $shareService;
    public function __construct()
    {
        $this->documentTypeService = app(DocumentTypeService::class);
        $this->shareService = app(DocumentShareService::class);
    }
    public function index()
    {
        return view('admin.document.index');
    }

    public function add()
    {
        $documentTypes = $this->documentTypeService->list(["paginate" => 0]);
        $shares = $this->shareService->list(["paginate" => 0]);
        return view('admin.document.add', compact(
            'documentTypes',
            'shares',
        ));
    }
}
