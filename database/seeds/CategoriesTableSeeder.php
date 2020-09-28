<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {

        $categories = ['cat one', 'cat two', 'cat three'];

        foreach ($categories as $category) {

            \App\Models\Category::create([
                'ar' => ['name' => $category],
                'en' => ['name' => $category],
            ]);

        }//end of foreach

    }//end of run
}
