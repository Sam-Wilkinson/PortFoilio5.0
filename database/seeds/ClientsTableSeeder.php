<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(App\Client::class, 10)->create()
        ->each(function($client){ 
            for($i = 0; $i < rand(1,3); $i++){
            $client->projects()->save(factory(App\Project::class)->make());
            }
            $client->testimonials()->save(factory(App\Testimonial::class)->make());

        });;
        $testimonials = App\Testimonial::all();
        $testimonials->each(function($testimonials){
            $projectNum = App\Project::all()->count();
            $testimonials->projects()->attach(rand(1,$projectNum));
        });
    }
}
