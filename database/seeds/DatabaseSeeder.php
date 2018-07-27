<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  DB::table('books')->insert([
        //     'title' => 'Food of Gods',
        //     'user_id' => 1,
        //     'description' => 'Lorem ipsum sucks'
        // ]);

        DB::table('users')->insert([
            'name' => 'Eli',
            'email'=> 'eli.hood@aol.com', 
            'password' => Hash::make('janemba'), 
        ]);

    }
}
