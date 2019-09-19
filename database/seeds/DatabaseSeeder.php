<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Project;
use App\Comment;


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
            'description' => 'Project Portaal Description',
        ]);

        DB::table('project_user')->insert([
            'user_id' => 1,
            'project_id' => 1,
        ]);


		$comment = new User;
		$user->student_id = random_int(10000, 999999);
		$user->email = Str::random(10).'@talnet.nl';
		$user->first_name = Str::random(5).'_fname';
		$user->last_name = Str::random(5).'_lname';
		$user->class_name = Str::random(5).'_7B';
		$user->isTeacher = random_int(0, 1);


		$project = new Project;
		$project->name = Str::random(5).'_pname';
		$project->slug = Str::random(5).'_slug';
		$project->description = Str::random(100).'_pdescription';

		
		$user->projects()->save($project);

    }
}
