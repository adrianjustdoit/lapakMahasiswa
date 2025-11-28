<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Seed default admin user
        $this->call([
            AdminUserSeeder::class,
        ]);

        Product::create([
            'user_id'        => 1, // ID penjual, sesuaikan dengan user yang ada
            'name'           => 'Mic Shure WB98 H/C',
            'description'    => "Mic clip condenser dengan kualitas suara jernih.\nCocok untuk kebutuhan vocal & instrumen di lingkungan kampus.",
            'shop_name'      => 'Lapak Audio Kampus',
            'condition'      => 'baru',
            'min_order'      => 1,
            'showcase'       => 'MICROPHONE CABLE',
            'price'          => 2999999,
            'average_rating' => 4.8,
            'reviews_count'  => 0,
            'sold_count'     => 10,
            'stock'          => 6,
        ]);
    }
}
