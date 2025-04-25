<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DocumentService;
use App\Services\DocumentShareService;
use App\Services\DocumentTypeService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    protected $documentTypeService;
    protected $shareService;
    protected $documentService;
    public function __construct()
    {
        $this->documentTypeService = app(DocumentTypeService::class);
        $this->shareService = app(DocumentShareService::class);
        $this->documentService = app(DocumentService::class);
    }
    public function index()
    {
        return view("admin.pages.document.index");
    }

    public function create()
    {
        $documentTypes = $this->documentTypeService->list(["paginate" => 0]);
        $shares = $this->shareService->list(["paginate" => 0]);
        return view('admin.pages.document.add', compact(
            'documentTypes',
            'shares',
        ));
    }

    public function edit($id)
    {
        $document = $this->documentService->show($id);
        $documentTypes = $this->documentTypeService->list(["paginate" => 0]);
        $shares = $this->shareService->list(["paginate" => 0]);
        return view('admin.pages.document.edit', compact(
            'documentTypes',
            'shares',
            'document',
        ));
    }

    public function view($id)
    {
        $document = $this->documentService->show($id);
        return view('admin.pages.document.view', compact(
            'document',
        ));
    }
}
