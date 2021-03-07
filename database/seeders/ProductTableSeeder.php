<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach(range(1,100) as $index){
        	Product::create([
        		"category_id"	=>rand(1,5),
        		"brand_id"		=>rand(1,5),
        		"product_name"	=>rtrim($faker->sentence(rand(2,5)),"."),
        		"product_price_regular"	=>rand(100,10000),
                "product_price_discount" =>rand(100,10000),
        		"product_quantity"=>rand(0,20),
        		"short_description"=>$faker->paragraph(rand(1,2),true),
        		"long_description"=>$faker->paragraph(rand(3,5),true),
        		"product_image"	=>$faker->imageUrl(),
        		"publication_status"	=>rand(0,1),


        	]);
        }
    }
}
