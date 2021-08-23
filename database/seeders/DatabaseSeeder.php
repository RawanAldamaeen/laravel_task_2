<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

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
        $faker = Faker::create();

        foreach (range(1,20) as $index) {
            DB::table('services')->insert([
                'name' => $faker->title,
                'detail' => $faker->text,
            ]);
        }
    }
}
