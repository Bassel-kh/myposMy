<?php

namespace App\Models;

// 1. To specify package’s class you are using
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use Translatable; // 2. To add translation methods
    protected $guarded = [];

    // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['name', 'description'];
    protected $appends = ['image_path', 'profit_percent'];

    public function getImagePathAttribute()
    {
        return asset('uploads/products_images/' . $this->image);


    }//end of image path attribute

    public function category()
    {

        return $this->belongsTo(Category::class);

    }
}
