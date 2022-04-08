<?php

namespace Database\Seeders\Faker;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class ProductFaker extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('products')->insert([
            'id' => 1,
            'category_id' => 1,
            'name' => 'Sản phẩm 01',
            'slug' => \Str::slug('Sản phẩm 01'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'id' => 2,
            'category_id' => 1,
            'name' => 'Sản phẩm 02',
            'slug' => \Str::slug('Sản phẩm 02'),
            'status' => 'activated',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
