<?php

use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Program::create([
            'faculty_id' => 1,
            'code' => '115',
            'name' => 'ingeniería de sistemas'
        ]);
    }
}
