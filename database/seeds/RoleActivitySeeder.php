<?php

use Illuminate\Database\Seeder;

class RoleActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\RoleActivity::create([
            'name' => 'Participante'
        ]);

        \App\Models\RoleActivity::create([
            'name' => 'Lider'
        ]);
    }
}
