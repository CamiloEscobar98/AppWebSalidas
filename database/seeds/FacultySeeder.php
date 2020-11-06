<?php

use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Faculty::create([
            'name' => 'facultad de ingeniería'
        ]);

        \App\Models\Faculty::create([
            'name' => 'ciencias de la salud'
        ]);

        \App\Models\Faculty::create([
            'name' => 'ciencias básicas'
        ]);

        \App\Models\Faculty::create([
            'name' => 'ciencias agrarias y del ambiente'
        ]);

        \App\Models\Faculty::create([
            'name' => 'ciencias empresariales'
        ]);

        \App\Models\Faculty::create([
            'name' => 'educación, artes y humanidades'
        ]);
    }
}
