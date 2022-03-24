<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "email" => "admin@domain.com",
            "password" => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'//password
        ]);

        User::factory(10)->create();
        Customer::factory(10)->create();
        Seller::factory(5)->create();
        Batch::factory(10)->create();
        Product::factory(100)->create();
    }
}
