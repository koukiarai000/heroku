<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile_history extends Model
{
    protected $guarded = array('id');
    
    public static $reles = array(
        'profiles_id' => 'required',
        'edited_at' => 'required',
        );
}
