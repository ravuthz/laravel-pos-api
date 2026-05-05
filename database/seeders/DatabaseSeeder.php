<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\ClientRepository;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User',
                'password' => '123123',
            ]);

        $admin = User::updateOrCreate(
            ['email' => 'adminz@gmail.com'],
            [
                'name' => 'Adminz',
                'password' => '123123',
            ]);

        if (config('app.env') === 'local') {
            $url = config('app.url');
            $service = new ClientRepository();
            $service->createPersonalAccessClient(null, 'Personal Token', $url);
            $service->createPasswordGrantClient(null, 'Password Token', $url);

            Auth::loginUsingId($admin->id);

            Store::factory(10)->create();

            $this->call(SettingSeeder::class);
            $this->call(CategorySeeder::class);
            $this->call(ProductSeeder::class);

            Auth::loginUsingId($user->id);
            Product::factory(50)->create();
        }
    }
}
