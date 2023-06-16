<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\History;

use Carbon\Carbon;

class ProfileController extends Controller
{
    
    public function add() {
        return view('admin.profile.create');
    }
    
    public function create(Request $request) {
        
        // Validationを行う
        $this->validate($request, Profile::$rules);
        
        $profile = new Profile;
        $form = $request->all();
        
        // フォームから送信された_tokenを削除する
        unset($form['_token']);
        
        // データベースに保存する
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile/create');
    }
    
    public function edit(Request $request) {
        
        $form = Profile::find($request->id);
        
        if (empty($form)) {
            abort(404);
        }
        
        // $formの値を'form'という名前でviewに渡す。これをしないとviewで変数が定義されていないことなる。
        return view('admin.profile.edit', ['form' => $form]);
        
    }
    
    public function update(Request $request) {
        
        // Validationをかける
        $this->validate($request, Profile::$rules);
        
        // Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        
        // 送信されてきたフォームデータを格納する
        $form = $request->all();
        
        unset($form['remove']);
        unset($form['_token']);
        
        // 該当するデータを上書きして保存する
        $profile->fill($form)->save();
        
        $history = new History();
        $history->profile_id = $profile->profile_id;
        $history->edited_at_profile = Carbon::now();
        $history->save();
        
        return redirect('admin.profile.edit', ['form' => $form]);
    }
    
}
