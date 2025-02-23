<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::set([
            'code' => '01',
            'name' => 'person_type',
            'value' => 'person_type',
        ])->setItems([
            [
                'code' => '0101',
                'name' => 'Owner',
                'value' => 'owner',
            ],
            [
                'code' => '0102',
                'name' => 'Customer',
                'value' => 'customer',
            ],
            [
                'code' => '0103',
                'name' => 'Employee',
                'value' => 'employee',
            ],
        ]);

        Setting::set([
            'code' => '02',
            'name' => 'Position',
            'value' => 'position',
        ])->setItems([
            [
                'code' => '0201',
                'name' => 'Cashier',
                'value' => 'cashier',
            ],
            [
                'code' => '0202',
                'name' => 'Table Service',
                'value' => 'server',
            ],
            [
                'code' => '0201',
                'name' => 'Cleaner',
                'value' => 'cleaner',
            ]
        ]);
    }
}
