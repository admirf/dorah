<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Admir',
            'email' => 'admir@misijaweb.com',
            'password' => bcrypt('secret'),
            'email_verified_at' => Carbon\Carbon::now()
        ]);
    }
}
