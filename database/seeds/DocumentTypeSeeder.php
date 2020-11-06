<?php

use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Document_type::create([
            'type' => 'c.c',
            'name' => 'cédula de ciudadanía',
        ]);

        \App\Models\Document_type::create([
            'type' => 't.i',
            'name' => 'tarjeta de identidad',
        ]);

        \App\Models\Document_type::create([
            'type' => 'c.c',
            'name' => 'cédula de extranjería',
        ]);
    }
}
