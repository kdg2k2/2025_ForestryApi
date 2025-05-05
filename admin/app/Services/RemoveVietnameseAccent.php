<?php

namespace App\Services;

class RemoveVietnameseAccent extends BaseService
{
    public function stringToSlug(string $str, int $option = 0)
    {
        return $this->catchAPI(function () use ($str, $option) {
            $from = '';
            $to = '';

            // remove all marks (Latin alphabet)
            if ($option === 0) {
                $from = 'àáãảạăằắẳẵặâầấẩẫậèéẻẽẹêềếểễệđùúủũụưừứửữựòóỏõọôồốổỗộơờớởỡợìíỉĩịäëïîöüûñçýỳỹỵỷ';
                $to   = 'aaaaaaaaaaaaaaaaaeeeeeeeeeeeduuuuuuuuuuuoooooooooooooooooiiiiiaeiiouuncyyyyy';
            }

            // remove tone mark (Vietnamese alphabet)
            if ($option === 1) {
                $from = 'àáãảạăằắẳẵặâầấẩẫậèéẻẽẹêềếểễệđùúủũụưừứửữựòóỏõọôồốổỗộơờớởỡợìíỉĩịäëïîöüûñçýỳỹỵỷ';
                $to   = 'aaaaaăăăăăăââââââeeeeeêêêêêêđuuuuuưưưưưưoooooôôôôôôơơơơơơiiiiiaeiiouuncyyyyy';
            }

            // Replace each character
            $str = mb_strtolower($str, 'UTF-8');
            for ($i = 0, $len = mb_strlen($from); $i < $len; $i++) {
                $fromChar = mb_substr($from, $i, 1, 'UTF-8');
                $toChar   = mb_substr($to, $i, 1, 'UTF-8');
                $str = preg_replace('/' . preg_quote($fromChar, '/') . '/iu', $toChar, $str);
            }

            // Convert to slug
            $str = preg_replace('/[^a-z0-9\-]/', '-', $str);
            $str = preg_replace('/-+/', '-', $str);
            $str = trim($str, '-');

            return $str;
        });
    }
}
