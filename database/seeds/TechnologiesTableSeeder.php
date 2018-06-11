<?php

use Illuminate\Database\Seeder;


class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('technologies')->insert([
            'name' => 'HTML',
            'description' =>'lorem',
            'competence' => '80'
        ]);
        DB::table('technologies')->insert([
            'name' => 'CSS',
            'description' =>'lorem',
            'competence' => '70'
        ]);
        DB::table('technologies')->insert([
            'name' => 'JavaScript',
            'description' =>'lorem',
            'competence' => '50'
        ]);
        DB::table('technologies')->insert([
            'name' => 'PhP',
            'description' =>'lorem',
            'competence' => '20'
        ]);
        $projects = App\Project::all();
        $projects->each(function($project){
            $project->technologies()->attach(rand(1,4));
        });

    }
}
