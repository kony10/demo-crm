<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class projectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i =0 ; $i< 5; $i++){

              Project::create([
                  'title' => $faker->sentence( $nbWords= 2, $variableWords = false ),
                  'description' => $faker->sentence( $nbWords= 5, $variableWords = false ),
                  'category' => false,
                  'project_manager_id' => false,
                  'status' => true,
              ]);

        }
    }
}
