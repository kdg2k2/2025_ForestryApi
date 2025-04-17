<?php

namespace App\Services;

class ImageUploadService extends BaseService
{
    public function store($image, string $folder)
    {
        $folder = "uploads/$folder";
        $publicFolder = public_path($folder);
        if (!is_dir($publicFolder))
            mkdir($publicFolder, 0777, true);

        $name = time() . "_" . $image->getClientOriginalName();
        $image->move($folder, $name);

        return "$folder/$name";
    }
}
