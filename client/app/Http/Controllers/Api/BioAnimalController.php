<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BioAnimalService;
use Illuminate\Http\Request;

class BioAnimalController extends Controller
{
    protected $bioAnimalService;
    public function __construct()
    {
        $this->bioAnimalService = app(BioAnimalService::class);
    }

    // public function store(Request $req)
    // {
    //     return $this->catchAPI(fn() => $this->bioAnimalService->store($req->validated()));
    // }

    // public function list(Request $req)
    // {
    //     return $this->catchAPI(fn() => $this->bioAnimalService->list($req->all()));
    // }
}
