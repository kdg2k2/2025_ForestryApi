<?php

namespace App\Services;

use App\Repositories\UserRoleRepository;
use App\Services\BaseService;

class UserRoleService extends BaseService
{
    protected $userRoleRepository;
    protected $orderService;
    public function __construct()
    {
        $this->orderService = app(OrderService::class);
        $this->userRoleRepository = app(UserRoleRepository::class);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $records = $this->userRoleRepository->list($request);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->userRoleRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->userRoleRepository->update($request);
        });
    }

    public function delete(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->userRoleRepository->delete($request);
        });
    }

    public function payment(array $request)
    {
        $role = $this->userRoleRepository->findById($request['id_role']);

        $res = (new VnpayService())->createPaymentUrl([
            'total' => $role->price,
            'type' => 'billpayment',
            'info' => "Thanh toán gia hạn quyền tài khoản lên $role->name_en ($role->name_vn)",
            'return_url' => route('admin.role.vnpay-return'),
        ]);

        $orderUserRole = (new OrderUserRoleService())->store([
            'id_order' => $res['order']['id'],
            'id_role' => $role->id,
            'price' => $role->price,
        ]);

        return $res['url'];
    }

    public function vnpayReturn(array $request)
    {
        $res = (new VnpayService())->vnpayReturn($request);
        if (in_array($res['status'], [400, 201]))
            return redirect(route('admin.role.upgrade'))->with('err', $res['message']);

        return redirect(route('admin.role.upgrade'))->with('success', $res['message']);
    }

    public function vnpayIpn($order)
    {
        return $this->tryThrow(function () use ($order) {
            $user = $order->user;
            $user->update([
                'id_role' => $order->orderUserRole->id_role,
                'role_expires_in' => date('d-m-Y H:i', strtotime('+1 month')),
            ]);
        });
    }
}
