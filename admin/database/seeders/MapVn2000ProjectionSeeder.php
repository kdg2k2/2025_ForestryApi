<?php

namespace Database\Seeders;

use App\Models\MapVn2000Projection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapVn2000ProjectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            ['province' => 'Toàn quốc', 'zone' => 'WGS84', 'epsg_code' => 4326],
            ['province' => 'Toàn quốc', 'zone' => 'UTM-WGS-84 - Zone 48', 'epsg_code' => 32648],
            ['province' => 'Toàn quốc', 'zone' => 'UTM-WGS-84 - Zone 49', 'epsg_code' => 32649],
            ['province' => 'Toàn quốc', 'zone' => 'UTM-WGS-84 - Zone 50', 'epsg_code' => 32650],
            ['province' => 'Toàn quốc', 'zone' => 'UTM-VN2000 - Zone 48', 'epsg_code' => 3405],
            ['province' => 'Toàn quốc', 'zone' => 'UTM-VN2000 - Zone 49', 'epsg_code' => 3406],
            ['province' => 'Toàn quốc', 'zone' => 'UTM-VN2000 - Zone 50', 'epsg_code' => 32650],
            ['province' => 'Hà Nội', 'zone' => 'VN2000 / TM-3 105-00', 'epsg_code' => 5897],
            ['province' => 'TP Hồ Chí Minh', 'zone' => 'VN2000 / TM-3 105-45', 'epsg_code' => 9210],
            ['province' => 'Hải Phòng', 'zone' => 'VN2000 / TM-3 105-45', 'epsg_code' => 9210],
            ['province' => 'Đà Nẵng', 'zone' => 'VN2000 / TM-3 107-45', 'epsg_code' => 5899],
            ['province' => 'Hà Giang', 'zone' => 'VN2000 / TM-3 105-30', 'epsg_code' => 9209],
            ['province' => 'Cao Bằng', 'zone' => 'VN2000 / TM-3 105-45', 'epsg_code' => 9210],
            ['province' => 'Lai Châu', 'zone' => 'VN2000 / TM-3 103-00', 'epsg_code' => 9205],
            ['province' => 'Lào Cai', 'zone' => 'VN2000 / TM-3 104-45', 'epsg_code' => 9208],
            ['province' => 'Tuyên Quang', 'zone' => 'VN2000 / TM-3 106-00', 'epsg_code' => 9211],
            ['province' => 'Lạng Sơn', 'zone' => 'VN2000 / TM-3 107-15', 'epsg_code' => 9215],
            ['province' => 'Bắc Kạn', 'zone' => 'VN2000 / TM-3 106-30', 'epsg_code' => 9213],
            ['province' => 'Thái Nguyên', 'zone' => 'VN2000 / TM-3 106-30', 'epsg_code' => 9213],
            ['province' => 'Yên Bái', 'zone' => 'VN2000 / TM-3 104-45', 'epsg_code' => 9208],
            ['province' => 'Sơn La', 'zone' => 'VN2000 / TM-3 104-00', 'epsg_code' => 9206],
            ['province' => 'Phú Thọ', 'zone' => 'VN2000 / TM-3 104-45', 'epsg_code' => 9208],
            ['province' => 'Vĩnh Phúc', 'zone' => 'VN2000 / TM-3 105-00', 'epsg_code' => 5897],
            ['province' => 'Quảng Ninh', 'zone' => 'VN2000 / TM-3 107-45', 'epsg_code' => 5899],
            ['province' => 'Bắc Giang', 'zone' => 'VN2000 / TM-3 107-00', 'epsg_code' => 9214],
            ['province' => 'Bắc Ninh', 'zone' => 'VN2000 / TM-3 105-30', 'epsg_code' => 9209],
            ['province' => 'Hải Dương', 'zone' => 'VN2000 / TM-3 105-30', 'epsg_code' => 9209],
            ['province' => 'Hưng Yên', 'zone' => 'VN2000 / TM-3 105-30', 'epsg_code' => 9209],
            ['province' => 'Hòa Bình', 'zone' => 'VN2000 / TM-3 106-00', 'epsg_code' => 9211],
            ['province' => 'Hà Nam', 'zone' => 'VN2000 / TM-3 105-00', 'epsg_code' => 5897],
            ['province' => 'Nam Định', 'zone' => 'VN2000 / TM-3 105-30', 'epsg_code' => 9209],
            ['province' => 'Thái Bình', 'zone' => 'VN2000 / TM-3 105-30', 'epsg_code' => 9209],
            ['province' => 'Ninh Bình', 'zone' => 'VN2000 / TM-3 105-00', 'epsg_code' => 5897],
            ['province' => 'Thanh Hóa', 'zone' => 'VN2000 / TM-3 105-00', 'epsg_code' => 5897],
            ['province' => 'Nghệ An', 'zone' => 'VN2000 / TM-3 104-45', 'epsg_code' => 9208],
            ['province' => 'Hà Tĩnh', 'zone' => 'VN2000 / TM-3 105-30', 'epsg_code' => 9209],
            ['province' => 'Quảng Bình', 'zone' => 'VN2000 / TM-3 106-00', 'epsg_code' => 9211],
            ['province' => 'Quảng Trị', 'zone' => 'VN2000 / TM-3 106-15', 'epsg_code' => 9212],
            ['province' => 'Thừa Thiên Huế', 'zone' => 'VN2000 / TM-3 107-00', 'epsg_code' => 9214],
            ['province' => 'Quảng Nam', 'zone' => 'VN2000 / TM-3 107-45', 'epsg_code' => 5899],
            ['province' => 'Quảng Ngãi', 'zone' => 'VN2000 / TM-3 zone 491', 'epsg_code' => 5898],
            ['province' => 'Kon Tum', 'zone' => 'VN2000 / TM-3 107-30', 'epsg_code' => 9216],
            ['province' => 'Bình Định', 'zone' => 'VN2000 / TM-3 108-15', 'epsg_code' => 9217],
            ['province' => 'Gia Lai', 'zone' => 'VN2000 / TM-3 108-30', 'epsg_code' => 9218],
            ['province' => 'Phú Yên', 'zone' => 'VN2000 / TM-3 108-30', 'epsg_code' => 9218],
            ['province' => 'Đắk Lắk', 'zone' => 'VN2000 / TM-3 108-30', 'epsg_code' => 9218],
            ['province' => 'Khánh Hòa', 'zone' => 'VN2000 / TM-3 108-15', 'epsg_code' => 9217],
            ['province' => 'Lâm Đồng', 'zone' => 'VN2000 / TM-3 107-45', 'epsg_code' => 5899],
            ['province' => 'Bình Phước', 'zone' => 'VN2000 / TM-3 106-15', 'epsg_code' => 9212],
            ['province' => 'Bình Dương', 'zone' => 'VN2000 / TM-3 105-45', 'epsg_code' => 9210],
            ['province' => 'Ninh Thuận', 'zone' => 'VN2000 / TM-3 108-15', 'epsg_code' => 9217],
            ['province' => 'Tây Ninh', 'zone' => 'VN2000 / TM-3 105-30', 'epsg_code' => 9209],
            ['province' => 'Bình Thuận', 'zone' => 'VN2000 / TM-3 108-30', 'epsg_code' => 9218],
            ['province' => 'Đồng Nai', 'zone' => 'VN2000 / TM-3 107-45', 'epsg_code' => 5899],
            ['province' => 'Long An', 'zone' => 'VN2000 / TM-3 105-45', 'epsg_code' => 9210],
            ['province' => 'Đồng Tháp', 'zone' => 'VN2000 / TM-3 105-00', 'epsg_code' => 5897],
            ['province' => 'An Giang', 'zone' => 'VN2000 / TM-3 104-45', 'epsg_code' => 9208],
            ['province' => 'Bà Rịa - Vũng Tàu', 'zone' => 'VN2000 / TM-3 107-45', 'epsg_code' => 5899],
            ['province' => 'Tiền Giang', 'zone' => 'VN2000 / TM-3 105-45', 'epsg_code' => 9210],
            ['province' => 'Kiên Giang', 'zone' => 'VN2000 / TM-3 104-30', 'epsg_code' => 9207],
            ['province' => 'Cần Thơ', 'zone' => 'VN2000 / TM-3 105-00', 'epsg_code' => 5897],
            ['province' => 'Bến Tre', 'zone' => 'VN2000 / TM-3 105-45', 'epsg_code' => 9210],
            ['province' => 'Vĩnh Long', 'zone' => 'VN2000 / TM-3 105-30', 'epsg_code' => 9209],
            ['province' => 'Trà Vinh', 'zone' => 'VN2000 / TM-3 105-30', 'epsg_code' => 9209],
            ['province' => 'Sóc Trăng', 'zone' => 'VN2000 / TM-3 105-30', 'epsg_code' => 9209],
            ['province' => 'Bạc Liêu', 'zone' => 'VN2000 / TM-3 105-00', 'epsg_code' => 5897],
            ['province' => 'Cà Mau', 'zone' => 'VN2000 / TM-3 104-30', 'epsg_code' => 9207],
            ['province' => 'Điện Biên', 'zone' => 'VN2000 / TM-3 103-00', 'epsg_code' => 9205],
            ['province' => 'Đắk Nông', 'zone' => 'VN2000 / TM-3 108-30', 'epsg_code' => 9218],
            ['province' => 'Hậu Giang', 'zone' => 'VN2000 / TM-3 105-00', 'epsg_code' => 5897],
        ];

        MapVn2000Projection::truncate();
        MapVn2000Projection::insert($arr);
    }
}
