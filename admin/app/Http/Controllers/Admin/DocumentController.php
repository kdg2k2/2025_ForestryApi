<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DocumentService;
use App\Services\DocumentShareService;
use App\Services\DocumentTypeService;
use App\Services\VnpayService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    protected $documentTypeService;
    protected $shareService;
    protected $documentService;
    protected $vnpayService;
    public function __construct()
    {
        $this->documentTypeService = app(DocumentTypeService::class);
        $this->shareService = app(DocumentShareService::class);
        $this->vnpayService = app(VnpayService::class);
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
        $res = $this->documentService->show($id);
        $documentTypes = $this->documentTypeService->list(["paginate" => 0]);
        $shares = $this->shareService->list(["paginate" => 0]);
        $document = $res['document'];
        return view('admin.pages.document.edit', compact(
            'documentTypes',
            'shares',
            'document',
        ));
    }

    public function payment(Request $request)
    {
        return redirect($this->documentService->payment($request->id));
    }

    public function vnpayReturn(Request $request)
    {
        return $this->documentService->vnpayReturn($this->vnpayService->vnpayReturn($request->all()));
    }

    public function view($id)
    {
        return view('admin.pages.document.view', $this->documentService->show($id));
    }
}
