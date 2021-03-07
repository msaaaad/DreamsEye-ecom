<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach(range(1,10) as $index){
        	$category=$faker->unique()->name;
        	Category::create([
        		"category_name"		=>$category,
        		"slug"				=>$this->slugfy($category),
        		"publication_status"=>rand(0,1),
        	]);
        }
    }
    public function slugfy($text)
    {
    	//replace non letters or digits
    	$text = preg_replace('~[^\pL\d]+~u', '-', $text);
    	//transliterate
    	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    	//remove unwanted characters
    	$text = preg_replace('~[^\w]+~', '', $text);
    	//trim
    	$text = trim($text,'-');
    	//lowercase
    	$text = strtolower($text);

    	if(empty($text)){
    		return 'N/A';
    	}
    	return $text;

    }
}
