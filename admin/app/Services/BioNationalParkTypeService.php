<?php

namespace App\Services;

use App\Lib\Constant;
use App\Repositories\BioNationalParkTypeRepository;
use App\Services\BaseService;
use Illuminate\Database\QueryException;

class BioNationalParkTypeService extends BaseService
{
    protected $BioNationalParkTypeRepository;
    public function __construct()
    {
        $this->BioNationalParkTypeRepository = app(BioNationalParkTypeRepository::class);
    }

    public function store(array $request)
    {
        return $this->BioNationalParkTypeRepository->store($request);
    }

    public function update(array $request)
    {
        return $this->BioNationalParkTypeRepository->update($request, $request['id']);
    }

    public function deleteSoft(int $id)
    {
        $type = $this->BioNationalParkTypeRepository->findById($id);
        if (!$type)
            throw new \Exception('Không tìm thấy loại vườn quốc gia', 404);
        return $this->BioNationalParkTypeRepository->deleteSoft($id);
    }

    public function restore(int $id)
    {
        $type = $this->BioNationalParkTypeRepository->findById($id, true);
        if (!$type)
            throw new \Exception('Không tìm thấy loại vườn quốc gia', 404);
        return $this->BioNationalParkTypeRepository->restore($id);
    }

    public function list(array $request)
    {
        $records = $this->BioNationalParkTypeRepository->list();
        if (isset($request["paginate"]) && $request["paginate"] == 1)
            $records = $this->paginate($records, $request["per_page"], $request["page"]);
        return $records;
    }
}
