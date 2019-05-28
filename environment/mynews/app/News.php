<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    
    //$reguardはcreateやupdateで値が代入されない
    protected $guarded = array('id');
    
    //$rules変数の中に連想配列を作成
    public static $rules = array(
        'title' => 'required',
        'body' =>'required',
        );
        
    //Newsモデルに関連付けを行う
    public function histories()
    {
        return $this->hasMany('App\History');
    }
}
