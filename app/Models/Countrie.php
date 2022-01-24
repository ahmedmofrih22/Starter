<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Countrie extends Model
{
    protected $table = "conutries";
    protected $fillable = ['name'];
    public $timestamps = false;

    public function doctor(){
        return $this->hasManyThrough('App\Models\doctor','App\Models\hospital','countrie_id','hospital_id','id','id');
    }
    public function hospital(){
        return $this->hasMany('App\Models\hospital','countrie_id','id');
    }
}
