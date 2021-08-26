<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Admin',
            'surname'=> 'Admin',
            'email'=>'admin@propay.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
