<?php

namespace Database\Seeders;

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
        // 1. カテゴリを先に作る
    $this->call(CategoriesTableSeeder::class);

    // 2. その後、コンタクトを35件作る
    \App\Models\Contact::factory(35)->create();
    }
}
