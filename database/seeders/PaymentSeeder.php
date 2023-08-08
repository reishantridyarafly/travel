<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = [
            [   
                'name_bank' => 'BRI',
                'account_number' => '389272323211',
                'name_owner' => 'CV Langkuy',
            ],
            [
                'name_bank' => 'BCA',
                'account_number' => '238239823',
                'name_owner' => 'CV Langkuy',
            ],
        ];

        DB::table('payments')->insert($payments);
    }
}
