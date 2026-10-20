<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        Product::create([
            'name' => 'Processor Ryzen 5600g',
            'category' => 'CPU',
            'price' => 100000,
            'stock' => 12,
            'image' => '',
        ]);

        Order::create([
            'invoice_code' => 'INV-'. rand(100,999),
            'customer_name' => 'Rojie',
            'customer_phone' => 8932985,
            'shipping_addres' => 'Tangsel',
            'total_amount' => 10000,
            'status' => 'pending'
        ]);
    }
}
