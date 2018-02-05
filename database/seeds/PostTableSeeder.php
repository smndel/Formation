<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	//Création des catégories pour les formations
        App\Category::create([
    		'name' => 'PHP'
    	]);
    	App\Category::create([
    		'name' => 'JAVASCRIPT'
    	]);
    	App\Category::create([
    		'name' => 'HTML/CSS'
    	]);
    	App\Category::create([
    		'name' => 'LARAVEL'
    	]);
    	App\Category::create([
    		'name' => 'WORDPRESS'
    	]);
    	App\Category::create([
    		'name' => 'ANGULAR'
    	]);

    	Storage::disk('local')->delete(Storage::AllFiles());

        factory(App\Post::class, 30)->create()->each(function($post){
        	$category = App\Category::find(rand(1,6));
        	$post->category()->associate($category);
        	$post->save();
        //Fin des affections des catégories
        
        //Assignation d'une image à une formation
        	$link = str_random(12).'.jpg';//hash de lien pour la sécurité(injection de sscripts de protection)
			$file = file_get_contents('http://placeimg.com/640/480/tech');
		 
			Storage::disk('local')->put($link, $file);

			$post->picture()->create([
		    	'title' =>'Default', //valeur par défaut
		    	'link'	=> $link,
		    ]);
		//Fin assignation d'une image


        //Relation des teachers avec les formations
        	$teachers = App\Teacher::pluck('id')->shuffle()->slice(0,rand(1,3))->all();
		    $post->teachers()->attach($teachers); 
    		});
        //Fin d'assignation des teachers

        

	}
}
