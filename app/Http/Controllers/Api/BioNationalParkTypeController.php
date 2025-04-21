<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BioNationalParkType\CreateRequest;
use App\Http\Requests\BioNationalParkType\UpdateRequest;
use App\Services\BioNationalParkTypeService;
use Illuminate\Http\Request;

class BioNationalParkTypeController extends Controller
{
    protected BioNationalParkTypeService $bioNationalParkTypeService;

    function __construct()
    {
        $this->bioNationalParkTypeService = app(BioNationalParkTypeService::class);
    }

    public function store(CreateRequest $request)
    {
        return $this->catchAPI(fn() => $this->bioNationalParkTypeService->store($request->validated()));
    }

    public function update(UpdateRequest $request, int $id)
    {
        return $this->catchAPI(fn() => $this->bioNationalParkTypeService->update($request->validated(), $id));
    }

    public function deleteSoft(int $id)
    {
        return $this->catchAPI(fn() => $this->bioNationalParkTypeService->deleteSoft($id));
    }

    public function restore(int $id)
    {
        return $this->catchAPI(fn() => $this->bioNationalParkTypeService->restore($id));
    }

    public function list()
    {
        return $this->catchAPI(fn() => $this->bioNationalParkTypeService->list());
    }
}
