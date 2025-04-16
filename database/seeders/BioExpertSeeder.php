<?php

namespace Database\Seeders;

use App\Models\BioExpert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BioExpertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BioExpert::truncate();
        $tableName = (new BioExpert())->getTable();
        DB::statement("INSERT INTO $tableName (id, name, email, work_unit, specialize, path) VALUES
(1, 'Hoàng Văn Sâm', 'samhv@vnuf.edu.vn', 'Trường Đại Học Lâm Nghiệp Việt Nam', 'Tiến sĩ thực vật rừng', 'biodiversity_f4/expert/1829377085_25_06_2024_5e54f6981e06bd58e417.jpg'),
(2, 'Nguyễn Hữu Cường', 'cuongnh@vnuf.edu.vn', 'Trường Đại học Lâm nghiệp', 'Tiến sĩ Thực vật rừng', 'biodiversity_f4/expert/2143618368_11_07_2024_e1fa29c3-f6c2-4dfb-9c71-6534a2b3455c.jpg'),
(3, 'Phan Văn Dũng', 'dungpv@vnuf.edu.vn', 'Trường Đại học Lâm nghiệp', 'Tiến sĩ Khoa học nông nghiệp', 'biodiversity_f4/expert/434597707_27_06_2024_phanvandung.jpg'),
(4, 'Nguyễn Văn Lý', 'lynv@vnuf.edu.vn', 'Trường Đại học Lâm nghiệp', 'Thạc sỹ Quản lý tài nguyên rừng', 'biodiversity_f4/expert/1816911996_27_06_2024_nguyenvanly.png'),
(5, 'Nguyễn Song Anh', 'nguyensonganh@ifee.edu.vn', 'Viện Sinh thái rừng và Môi trường', 'Thạc sỹ Kinh tế Nông nghiệp', 'biodiversity_f4/expert/768140293_27_06_2024_nguyensonganh.png');");
    }
}
