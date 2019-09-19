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
        DB::table('users')->insert([
            'student_id' => rand(40000, 80000),
            'email' => Str::random(10).'@talnet.nl',
            'first_name' => 'Willem',
            'last_name' => 'de Jong',
            'class_name' => 'OITAOO7B',
            'password' => bcrypt('password'),
        ]);

        DB::table('projects')->insert([
            'name' => 'Project Portaal',
            'slug' => 'project-portaal',
            'title' => 'Project Portaal Title',
            'description' => 'Project Portaal Description',
        ]);

        DB::table('project_user')->insert([
            'user_id' => 1,
            'project_id' => 1,
        ]);
    }
}
