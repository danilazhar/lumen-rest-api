<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) {
            User::create([
                'name' => Str::random(8),
                'email' => Str::random(12).'@mail.com',
            ]);
        }
    }
}
