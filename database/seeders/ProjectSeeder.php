<?php

namespace Database\Seeders;

use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 20; $i++){
            $new_project = new Project();
            $new_project->name = $faker->catchPhrase();
            $new_project->slug = Project::generateSlug($new_project->name);
            $new_project->user_id = User::inRandomOrder()->first()->id;
            $new_project->client_name = $faker->company();
            $new_project->summary = $faker->realText($maxNbChars = 300, $indexSize = 2);

            $new_project->save();
        }
    }
}
