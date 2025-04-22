<?php

namespace App\Services;

use App\Repositories\BioAnimalRepository;

class BioAnimalService extends BaseService
{
    protected $bioAnimalRepository;

    public function __construct()
    {
        $this->bioAnimalRepository = app(BioAnimalRepository::class);
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            if (isset($request['manganh']) || isset($request['nganhtv']) || isset($request['nganhlatin'])) {
                $col = 'manganh';
                if (isset($request['nganhtv']))
                    $col = 'nganhtv';
                else if (isset($request['nganhlatin']))
                    $col = 'nganhlatin';
                $phylums = $this->bioAnimalRepository->getPhylum($request[$col], $col);
                if ($phylums) {
                    $request['manganh'] = $phylums->manganh;
                    $request['nganhtv'] = $phylums->nganhtv;
                    $request['nganhlatin'] = $phylums->nganhlatin;
                }
            }

            // } else if (isset($request['nganhtv'])) {
            //     $phylums = $this->bioAnimalRepository->getPhylum($request['manganh'], 'nganhtv');
            //     if ($phylums) {
            //         $request['manganh'] = $phylums->manganh;
            //         $request['nganhtv'] = $phylums->nganhtv;
            //         $request['nganhlatin'] = $phylums->nganhlatin;
            //     }
            // }
            // if (isset($request['nganhlatin'])) {
            //     $phylums = $this->bioAnimalRepository->getPhylum($request['manganh'], 'nganhlatin');
            //     if ($phylums) {
            //         $request['manganh'] = $phylums->manganh;
            //         $request['nganhtv'] = $phylums->nganhtv;
            //         $request['nganhlatin'] = $phylums->nganhlatin;
            //     }
            // $record = $this->bioAnimalRepository->store($request);
        });
    }
}
