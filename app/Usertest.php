<?php

namespace App;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class Usertest extends Authenticatable
{
    use  LaratrustUserTrait, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
//
    protected function serializeDate(DateTimeInterface $date) : string
    {
        return $date->format('Y-m-d H:i:s');
//        return $date->format('H:i:s');
    }

//    public function getCreatedAtAttribute(){
//
//        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']) )->diffForHumans();
//    }

//    public function getUpdatedAtAttribute(){
//
//        return Carbon::createFromTimeStamp(strtotime($this->attributes['updated_at']) )->diffForHumans();
//    }


}
