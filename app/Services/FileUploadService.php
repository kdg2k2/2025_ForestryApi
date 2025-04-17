<?php

namespace App\Services;

class FileUploadService extends BaseService
{
    protected function store($file, string $folder)
    {
        $folder = "uploads/$folder";
        $publicFolder = public_path($folder);
        if (!is_dir($publicFolder))
            mkdir($publicFolder, 0777, true);

        $name = date('dmYHis') . "_" . $file->getClientOriginalName();
        $file->move($folder, $name);

        return "$folder/$name";
    }

    public function storeImage($image)
    {
        return $this->tryThrow(function () use ($image) {
            return $this->store($image, "images");
        });
    }

    public function storeDocument($document)
    {
        return $this->tryThrow(function () use ($document) {
            return $this->store($document, "documents");
        });
    }
}
