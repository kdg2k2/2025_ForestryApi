<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BioNationalPark\CreateRequest;
use App\Http\Requests\BioNationalPark\UpdateRequest;
use App\Services\BioNationalParkService;
use Illuminate\Http\Request;

class BioNationalParkController extends Controller
{
    protected BioNationalParkService $bioNationalParkService;
    public function __construct()
    {
        $this->bioNationalParkService = app(BioNationalParkService::class);
    }
    public function store(CreateRequest $req)
    {
        return $this->catchAPI(fn() => $this->bioNationalParkService->store($req->validated()));
    }

    public function list(Request $req)
    {
        return $this->catchAPI(fn() => $this->bioNationalParkService->list($req->all()));
    }

    public function update(UpdateRequest $req, int $id)
    {
        return $this->catchAPI(fn() => $this->bioNationalParkService->update($req->validated(), $id));
    }

    public function deleteSoft(int $id)
    {
        return $this->catchAPI(fn() => $this->bioNationalParkService->deleteSoft($id));
    }
    public function restore(int $id)
    {
        return $this->catchAPI(fn() => $this->bioNationalParkService->restore($id));
    }
}
