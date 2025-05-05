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

    public function storeImage($image, bool $isFullUrl = true)
    {
        return $this->tryThrow(function () use ($image, $isFullUrl) {
            $imagePath = $this->store($image, "images");
            return $isFullUrl ? url($imagePath) : $imagePath;
        });
    }

    public function storeDocument($document, bool $isFullUrl = true)
    {
        return $this->tryThrow(function () use ($document, $isFullUrl) {
            $documentPath = $this->store($document, "documents");
            return $isFullUrl ? url($documentPath) : $documentPath;
        });
    }
}
