<?php
namespace App\Repositories;

use App\Models\BioAnimal;

class BioAnimalRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = app(BioAnimal::class);
    }

    public function store(array $request)
    {
        return $this->model->create($request);
    }

    public function update(array $request, int $id)
    {
        return $this->model->where('id', $id)->update($request);
    }

    public function deleteSoft(int $id)
    {
        return $this->model->where('id', $id)->delete();
    }
    public function deleteHard(int $id)
    {
        return $this->model->where('id', $id)->forceDelete();
    }
    public function restore(int $id)
    {
        return $this->model->withTrashed()->where('id', $id)->restore();
    }
    public function list(array $request)
    {
        return $this->model->where($request)->get();
    }
    public function findById(int $id, $delete = false)
    {
        if (!$delete)
            return $this->model->find($id);
        return $this->model->withTrashed()->find($id);
    }
    public function findBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function getPhylum(string $codePhylum, string $col = 'manganh')
    {
        return $this->model->where($col, $codePhylum)->first([
            'manganh',
            'nganhtv',
            'nganhlatin',
        ]);
    }
}
