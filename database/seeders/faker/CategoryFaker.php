<?php

namespace Database\Seeders\Faker;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class CategoryFaker extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('categorys')->insert([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Danh mục 01',
            'slug' => \Str::slug('Danh mục 01'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categorys')->insert([
            'id' => 2,
            'user_id' => 1,
            'name' => 'Danh mục 02',
            'slug' => \Str::slug('Danh mục 02'),
            'status' => 'activated',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
