<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Faker\UserFaker;
use Database\Seeders\Faker\AccesseFaker;
use Database\Seeders\Faker\CategoryFaker;
use Database\Seeders\Faker\ProductFaker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserFaker::class);
        $this->call(AccesseFaker::class);
        $this->call(CategoryFaker::class);
        $this->call(ProductFaker::class);
    }
}
