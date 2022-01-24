<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = "services";
    protected $fillable = ['name' ,'created_at','updated_at'];
    protected $hidden = ['created_at','updated_at','pivot'];
    public $timestamps = true;


    public function doctor(){

        return $this ->belongsToMany('App\Models\Doctor','doctor_service','service_id','doctor_id','id','id');

    } 
}
