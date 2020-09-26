<?php

namespace App;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use  LaratrustUserTrait, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password','image'
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute(){

        return  asset('uploads/userImages/'.$this->image);
    } // end of get image path


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function serializeDate(DateTimeInterface $date) : string
    {
        return $date->format('Y-m-d H:i:s');
//        return $date->format('H:i:s');
    }

//    public function getCreatedAtAttribute(){
//
//        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']) )->diffForHumans();
//    }

//      public function getUpdatedAtAttribute(){
//
//        return Carbon::createFromTimeStamp(strtotime($this->attributes['updated_at']) )->diffForHumans();
//    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];

//    public function getFirstNameAttribute($value){
//        return ucfirst($value);
//    }
//
//    public function getLastNameAttribute($value){
//        return ucfirst($value);
//    }
}
