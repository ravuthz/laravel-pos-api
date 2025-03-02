<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => '123123',
        ]);

        User::factory()->create([
            'name' => 'Adminz',
            'email' => 'adminz@gmail.com',
            'password' => '123123',
        ]);

        if (config('app.env') === 'local') {
            $url = config('app.url');
            $service = new ClientRepository();
            $service->createPersonalAccessClient(null, 'Personal Token', $url);
            $service->createPasswordGrantClient(null, 'Password Token', $url);

            $this->call(SettingSeeder::class);

            Store::factory(10)->create();
        }
    }
}
