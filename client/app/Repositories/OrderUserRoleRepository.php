<?php

namespace App\Repositories;

use App\Models\OrderUserRole;

class OrderUserRoleRepository
{
    public function store(array $request)
    {
        return OrderUserRole::create($request);
    }
}
