<?php

namespace App\Models\Role_Permission;

use Carbon\Carbon;
use DateTimeInterface;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];

    protected function serializeDate(DateTimeInterface $date) : string
    {
        return $date->format('Y-m-d H:i:s');
//        return $date->format('H:i:s');
    }

//    public function getUpdatedAtAttribute(){
//
//        return Carbon::createFromTimeStamp(strtotime($this->attributes['updated_at']) )->diffForHumans();
//    }

}
