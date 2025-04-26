<?php

namespace App\Services;

use Exception;

class PdfToImageService extends BaseService
{
    public function DocumentToImages(int $id, string $fullPathToPdf)
    {
        return $this->tryThrow(function () use ($id, $fullPathToPdf) {
            if (!file_exists($fullPathToPdf))
                throw new Exception("File gốc không tồn tại");

            $outputDir = public_path("uploads/documents/$id/images");
            if (!is_dir($outputDir)) mkdir($outputDir, 0777, true);

            $paths = [];

            // 1) Khởi tạo instance
            $imagick = new Imagick();

            // 2) Ping để lấy metadata, không load toàn bộ PDF vào memory
            $imagick->pingImage($fullPathToPdf);

            // 3) Đếm số trang (số images)
            $totalPages = $imagick->getNumberImages();
            for ($i = 0; $i < $totalPages; $i++) {
                $imagick = new Imagick();
                // 1. set độ phân giải nếu cần
                $imagick->setResolution(150, 150);
                // 2. set nền trắng trước khi load PDF
                $imagick->setBackgroundColor(new ImagickPixel('white'));
                // 3. đọc đúng trang i (zero-based index)
                $imagick->readImage($fullPathToPdf . "[$i]");
                // 4. gộp layer / tắt alpha để loại transparency
                $imagick->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
                // 5. set định dạng PNG
                $imagick->setImageFormat('png');
                // 6. ghi file
                $filePath = $outputDir . DIRECTORY_SEPARATOR . date('dmYHis') . '.png';
                $imagick->writeImage($filePath);
                $imagick->clear();

                $paths[] = $filePath;
                sleep(1);
            }

            return $paths;
        });
    }
}
