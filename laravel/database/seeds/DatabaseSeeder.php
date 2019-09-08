<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Poblando Usuario
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('rodrigo'),
        ]);

        // Poblando Pais
        DB::table('pais')->insert([
            'nombre' => 'Bolivia',
        ]);


    }
}
