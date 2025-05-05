<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminService;
    public function __construct()
    {
        $this->adminService = app(AdminService::class);
    }

    public function index()
    {
        return view("admin.pages.admin.index");
    }

    public function create()
    {
        return view("admin.pages.admin.add", $this->adminService->loadNeededData());
    }

    public function edit()
    {
        $id = request()->id;
        $data = $this->adminService->findById($id);
        $needed = $this->adminService->loadNeededData();
        return view(
            "admin.pages.admin.edit",
            array_merge(
                $needed,
                [
                    'id' => $id,
                    'data' => $data,
                ]
            ),
        );
    }
}
