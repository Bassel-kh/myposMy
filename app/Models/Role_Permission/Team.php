<?php

namespace App\Models\Role_Permission;

use DateTimeInterface;
use Laratrust\Models\LaratrustTeam;

class Team extends LaratrustTeam
{
    public $guarded = [];


    protected function serializeDate(DateTimeInterface $date) : string
    {
        return $date->format('Y-m-d H:i:s');
//        return $date->format('H:i:s');
    }
}
