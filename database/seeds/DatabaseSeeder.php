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

		for ($i=0; $i < 8; $i++) {
			$user = new User;
			$user->student_id = random_int(10000, 999999);
			$user->email = Str::random(10).'@talnet.nl';
			$user->first_name = Str::random(5).'_fname';
			$user->last_name = Str::random(5).'_lname';
			$user->class_name = Str::random(5).'_7B';
			$user->isTeacher = random_int(0, 1);
			$user->password = bcrypt('password');

			$project = new Project;
			$project->name = Str::random(5).'_pname';
			$project->slug = Str::random(5).'_slug';
			$project->description = Str::random(100).'_pdescription';

			$comment = new Comment;
			$comment->comment = Str::random(50).'_comment';



			$user->save();
			$project->save();

			$comment->user_id = $user->id;

			$user->projects()->attach($project->id);
			$project->comments()->save($comment);

		}
    }
}
