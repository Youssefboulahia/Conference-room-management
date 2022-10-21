<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserStorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id'=>2,
                'name' => 'Secretary',
                'email' => 'secretary@gmail.com',
                'password' => Hash::make('12345'),
                'role' => 'secretary',
            ]
        ]);
    }
}
