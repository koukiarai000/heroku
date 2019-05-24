<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profiles extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
        );
    
    //profilesモデルに関連付けをする
    public function profile_histories() 
    {
        return $this->hasMany('App\profile_history');
    }
}
