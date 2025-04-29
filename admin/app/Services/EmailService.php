<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService extends BaseService
{
    public function sendMail(string $view, string $subject, array $emails, array $data, array $files = [])
    {
        return $this->tryThrow(function () use ($view, $subject, &$emails, $data, $files) {
            // lọc trùng email và loại bỏ email rỗng
            $emails = array_unique($emails);
            $emails = array_filter($emails, function ($value) {
                return !empty($value);
            });

            // nếu là local thì chỉ mail cho dev
            if ($this->isLocal() == true)
                $emails = ['dangnguyen.xmg@xuanmaijsc.vn'];

            // gửi mail
            Mail::send(
                $view,
                $data,
                function ($mess) use ($emails, $subject, $files) {
                    $mess->to($emails);
                    $mess->subject($subject);
                    if (!empty($files))
                        array_map(function ($item) use ($mess) {
                            if (file_exists($item))
                                $mess->attach($item);
                        }, $files);
                }
            );
        });
    }
}
