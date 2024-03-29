<?php

use App\UserInterest;
use App\UserLanguage;
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
        factory(UserLanguage::class, 5)->create();
        factory(UserInterest::class, 5)->create();
        $this->call(UsersSeeder::class);
    }
}
