<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = "doctors";
    protected $fillable = ['name' ,'title','hospital_id','created_at','medical_id','updated_at'];
    protected $hidden = ['created_at','updated_at','pivot'];
    public $timestamps = true;

    public function hospital(){
        return $this->belongsTo('App\Models\Hospital','hospital_id','id');
    }

    public function service(){
        return $this ->belongsToMany('App\Models\Service','doctor_service','doctor_id','service_id','id','id');
    }
######## accessors ##########
    public function getGenderAttribute($val){
        return $val== 1 ?'male':'female';
    }
    ######## accessors ##########




}