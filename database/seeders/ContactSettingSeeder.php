<?php

namespace Database\Seeders;

use App\Models\ContactSetting;
use Illuminate\Database\Seeder;

class ContactSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactSetting::updateOrCreate(
            ['id' => 1],
            [
                'office_name' => 'Office Space',
                'address' => "Jakarta SCBD Area, Sudirman St. 123\nMetropolitan District, ID 12190",
                'email' => 'hello@swarattive.com',
                'phone' => '+62 812 3456 7890',
                'map_coordinates' => '-2.6219595688745705, 101.35777227479358',
            ]
        );
    }
}
