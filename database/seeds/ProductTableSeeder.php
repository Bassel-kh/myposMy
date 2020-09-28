<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        $products = ['pro one', 'pro two'];
        $categories = ['cat one', 'cat two', 'cat three'];
        foreach ($categories as $key =>$category){
        foreach ($products as $product) {

            \App\Models\Product::create([
                'category_id' => $key + 1,
                'ar' => ['name' => $product .' '.$category, 'description' => $product . ' desc'],
                'en' => ['name' => $product .' '.$category, 'description' => $product . ' desc'],
                'purchase_price' => 100,
                'sale_price' => 150,
                'stock' => 100,
            ]);

        }//end of foreach 2
    }//end of foreach 1


    }//end of run

}
