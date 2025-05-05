<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRole\UpgradeRequest;
use App\Services\UserRoleService;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    protected $userRoleService;
    public function __construct()
    {
        $this->userRoleService = app(UserRoleService::class);
    }

    public function upgrade()
    {
        return view('admin.pages.role.update.index');
    }

    public function payment(UpgradeRequest $request)
    {
        return redirect($this->userRoleService->payment($request->validated()));
    }

    public function vnpayReturn(Request $request)
    {
        $res = $this->userRoleService->vnpayReturn($request->all());
        return redirect($res['route'])->with($res['message_type'], $res['message']);
    }
}
