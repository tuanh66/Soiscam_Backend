<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reports')->delete();
        DB::table('reports')->truncate();
        DB::table('reports')->insert([
            [
                'nameScammer'   => 'Nguyễn Thành',
                'phoneScammer'  => '0973244767',
                'bankNumber'    => '12072016080999',
                'bankName'      => 'MB BANK',
                'contentReport' => 'Bảo ship tỉnh cọc trước rồi lên đơn, nhắn như đúng rồi, có cả địa chỉ: D/c:Lôsô5, Đại Hoàng Sơn, đường Ngô Gia Tự, Ngô Quyền, TPBắcGiang',
                'imagesProof'   => json_encode(["https://i.ibb.co/GQQGLT0M/896689-IMG-9330.png", "https://i.ibb.co/GQQGLT0M/896689-IMG-9330.png", "https://i.ibb.co/GQQGLT0M/896689-IMG-9330.png"]),
                'nameSender'    => 'Nguyễn Thảo Nhi',
                'phoneSender'   => '0905164255',
                'option'        => 'Tôi chỉ đăng hộ',
                'approve'       => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nameScammer'   => 'NGUYỄN VĂN TRƯỜNG',
                'phoneScammer'  => '0358399999 ',
                'bankNumber'    => '926329652',
                'bankName'      => 'VIB BANK',
                'contentReport' => 'chiếm đoạt tài sản giao dịch trung gian',
                'imagesProof'   => json_encode(["https://i.ibb.co/mwJWtcD/197277-IMG-3802.png", "https://ibb.co/P8GS9fg", "https://ibb.co/JRhMD8qP", "https://ibb.co/nMLKx2xw", "https://ibb.co/WCRbSYV", "https://ibb.co/YBZZfpvw", "https://ibb.co/F4J3Tndn"]),
                'nameSender'    => 'Nguyễn Thảo Nhi',
                'phoneSender'   => '0905164255',
                'option'        => 'Tôi chỉ đăng hộ',
                'approve'       => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
