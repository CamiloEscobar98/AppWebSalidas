<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            DocumentTypeSeeder::class,
            FacultySeeder::class,
            ProgramSeeder::class,
            UserSeeder::class,
            ActivitySeeder::class,
            RoleActivitySeeder::class
        ]);
    }
}
