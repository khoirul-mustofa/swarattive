<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contact_settings')->truncate();

        DB::table('contact_settings')->insert([
            'office_name' => 'Swarattive Studio Kemang',
            'phone' => '+62 812-9900-8822',
            'email' => 'info@swarattive.com',
            'address' => 'Jl. Kemang Raya No. 45, Kemang, Jakarta Selatan, 12730',
            'map_coordinates' => '-6.2731, 106.8123',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
