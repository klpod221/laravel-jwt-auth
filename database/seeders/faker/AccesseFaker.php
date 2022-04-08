<?php

namespace Database\Seeders\Faker;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class AccesseFaker extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('accesses')->insert([
            'id' => 1,
            'user_id' => 1,
            'confirmation_code' => str_shuffle(md5(uniqid(mt_rand(), true)).time())
        ]);

        DB::table('accesses')->insert([
            'id' => 2,
            'user_id' => 2,
            'confirmation_code' => str_shuffle(md5(uniqid(mt_rand(), true)).time())
        ]);
    }
}
