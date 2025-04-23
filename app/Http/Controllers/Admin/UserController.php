<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserRoleService;
use App\Services\UserService;
use App\Services\UserUnitService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    protected $roleService;

    protected $unitService;

    public function __construct()
    {
        $this->userService = app(UserService::class);
        $this->roleService = app(UserRoleService::class);
        $this->unitService = app(UserUnitService::class);
    }
    public function index(Request $request)
    {
        return view('admin.users.online');
    }
    public function edit(Request $request)
    {
        $user = $this->userService->findById(intval($request->id));
        if (empty($user))
            return redirect()->route('admin.users.index')->with('err', 'Không tìm thấy người dùng');
        $roles = $this->roleService->list(["paginate" => 0]);
        $units = $this->unitService->list(["paginate" => 0]);
        return view('admin.users.edit', [
            'data' => $user,
            'roles' => $roles,
            'units' => $units,
        ]);
    }

    public function add(Request $request)
    {
        $roles = $this->roleService->list(["paginate" => 0]);
        $units = $this->unitService->list(["paginate" => 0]);
        return view('admin.users.add', [
            'roles' => $roles,
            'units' => $units,
        ]);
    }
}
