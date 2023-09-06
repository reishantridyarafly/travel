<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndikatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indikators = [
            [
                'kode_indikator' => '001',
                'name' => 'Tangibles',
            ],
            [
                'kode_indikator' => '002',
                'name' => 'Reliability',
            ],
            [
                'kode_indikator' => '003',
                'name' => 'Responsive',
            ],
            [
                'kode_indikator' => '004',
                'name' => 'Assurance',
            ],
            [
                'kode_indikator' => '005',
                'name' => 'Emphaty',
            ],
            [
                'kode_indikator' => '006',
                'name' => 'Hasil',
            ],
        ];

        DB::table('indikators')->insert($indikators);
    }
}
