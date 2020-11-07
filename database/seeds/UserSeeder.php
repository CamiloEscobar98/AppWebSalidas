<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = \App\User::create([
            'name' => 'andrés camilo',
            'lastname' => 'yáñez escobar',
            'code' => '1151505',
            'password' => bcrypt('1234'),
            'emailu' => 'andrescamiloye@ufps.edu.co',
            'program_id' => 1,
            'document_id' => \App\Models\Document::create([
                'document_type_id' => 1,
                'document' => '1090522152'
            ])->id,
            'image_id' => \App\Models\ImageProfile::create([
                'image' => 'default.jpg',
                'url' => 'storage/images/'
            ])->id
        ]);

        $usuario->roles()->attach(1);

        factory(\App\User::class, 20)->create();
    }
}
