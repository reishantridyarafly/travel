<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubindikatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subindikators = [
            [
                'kode_subindikator' => '001',
                'name' => 'Ketersediaan fasilitas dan informasi yang diberikan',
                'indikator_id' => 1,
            ],
            [
                'kode_subindikator' => '002',
                'name' => 'Penampilan Crew Langkuy yang bersih dan rapih',
                'indikator_id' => 1,
            ],
            [
                'kode_subindikator' => '003',
                'name' => 'Perlengkapan dalam memudahkan pelayanan',
                'indikator_id' => 1,
            ],
            [
                'kode_subindikator' => '004',
                'name' => 'Kemudahan prosedur dalam memberikan pelayanan',
                'indikator_id' =>  2,
            ],
            [
                'kode_subindikator' => '005',
                'name' => 'Kemudahan memberikan informasi kepada pelanggan',
                'indikator_id' =>  2,
            ],
            [
                'kode_subindikator' => '006',
                'name' => 'Crew Langkuy bekerja dengan baik dan memenuhi kebutuhan pelanggan',
                'indikator_id' =>  2,
            ],
            [
                'kode_subindikator' => '007',
                'name' => 'Ketepatan waktu dan kedisiplinan Crew Langkuy',
                'indikator_id' => 3,
            ],
            [
                'kode_subindikator' => '008',
                'name' => 'Rasa tanggungjawas atas pekerjaan Crew Langkuy',
                'indikator_id' => 3,
            ],
            [
                'kode_subindikator' => '009',
                'name' => 'Kesediaan Crew Langkuy untuk membantu pelanggan',
                'indikator_id' => 3,
            ],
            [
                'kode_subindikator' => '0010',
                'name' => 'Kesopanan, Keramahan serta Komunikasi yang baik dalam memberikan pelayanan',
                'indikator_id' =>  4,
            ],
            [
                'kode_subindikator' => '0011',
                'name' => 'Kejaminan fasilitas yang diberikan',
                'indikator_id' =>  4,
            ],
            [
                'kode_subindikator' => '0012',
                'name' => 'Crew Langkuy memiliki pengetahuan luas tentang destinasi wisata',
                'indikator_id' =>  4,
            ],
            [
                'kode_subindikator' => '0013',
                'name' => 'Keramahan Crew Langkuy terhadap pelanggan',
                'indikator_id' =>  5,
            ],
            [
                'kode_subindikator' => '0014',
                'name' => 'Ketersediaan waktu Crew Langkuy dalam mendengar keluhan pelanggan',
                'indikator_id' =>  5,
            ],
            [
                'kode_subindikator' => '0015',
                'name' => 'Crew Langkuy dapat berkomunikasi dengan baik',
                'indikator_id' =>  5,
            ],
            [
                'kode_subindikator' => '0016',
                'name' => 'Apakah anda puas dengan pelayanan kami',
                'indikator_id' =>  6,
            ],
        ];

        DB::table('subindikators')->insert($subindikators);
    }
}
