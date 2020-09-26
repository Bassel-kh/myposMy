<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 1. To specify package’s class you are using
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
//    protected $fillable = ['name'];

    use Translatable; // 2. To add translation methods
    protected $guarded = [];

    // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['name'];

    // the relation between Category and Product
    public function products()
    {

        return $this->hasMany(Product::class);

    }


}
