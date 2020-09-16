<?php

namespace App\Models\Role_Permission;

use DateTimeInterface;
use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{

    public $guarded = [];

    /**
     * Prepare a date for array / JSON serialization.
     */
    protected function serializeDate(DateTimeInterface $date) : string
    {
        return $date->format('Y-m-d H:i:s');
//        return $date->format('H:i:s');
    }

//    public function getCreatedAtAttribute($value)
//    {
//        // example
//        return $value->diffForHumans();
//
//    }
//
//    public function getUpdatedAtAttribute($value)
//    {
//        // example
//        return $value->diffForHumans();
//
//    }
}
