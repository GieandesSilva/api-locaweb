<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Gieandes Silva',
            'email' => 'contato@gieandessilva.com',
            'password' => bcrypt('Test@2019'),
        ]);
    }
}