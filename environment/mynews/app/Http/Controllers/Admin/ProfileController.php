<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\profiles;

class ProfileController extends Controller
{
    public function add()
    {
        //resources/views/admin/profile/create.blade.phpファイルを呼び出す
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        // Varidationを行う
        $this->validate($request, profiles::$rules);
        $profiles = new profiles;
        $form = $request->all();
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        
        // データベースに保存する
        $profiles->fill($form);
        $profiles->save();
        
        return redirect('admin/profile');
    }
    
    public function index(Request $request)
    {
        //$requestの中のcond_titleを代入している
        $cond_name = $request->cond_name;
        if ($cond_name != '') {
            //検索されたら検索結果を取得する
            $posts = profiles::where('name',$cond_name)->get();
        } else {
            //それ以外は全てのニュースを取得する
            $posts = profiles::all();
        }
        return view('admin.profile.index',['posts' => $posts, 'cond_name'=> $cond_name]);
    }
    
    public function edit(Request $request)
    {
        //¥app¥profiles Modelからデータを取得する
        $profiles = profiles::find($request->id);
        if (empty($profiles)) {
            abort(404);
        }
        return view('admin.profile.edit',['profiles_form' => $profiles]);
    }
    
    public function update(Request $request)
    {
        //Validationをかける
        $this->validate($request, profiles::$rules);
        
        //profiles Modelからデータを取得する
        $profiles = profiles::find($request->id);
        
        //送信さてきたフォームデータを格納する
        $profiles_form = $request->all();
        unset($profiles_form['_token']);
        
        //該当するデータを上書きして保存する
        $profiles->fill($profiles_form)->save();
        
        return redirect('admin/profile');
    }
    public function delete(Request $request)
    {
        $profiles = profiles::find($request->id);
        $profiles->delete();
        return redirect('admin/profile/');
    }
    
}
