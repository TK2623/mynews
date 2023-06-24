<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\ProfileHistory;

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
        
        // フォームから画像が送信されたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['profile-image'])) {
            
            // file関数で画像ファイルのフルパスを取得する。store関数でファイル名だけを取り出す。ファイル名を$pathに入れる。
            $path = $request->file('profile-image')->store('public/image');
            // 画像のファイル名をimage_pathに入れる。
            $profile->image_path = basename($path);
            
        } else {
            // 画像が送られなければimage_pathにnullを入れる。
            $profile->image_path = null;
        }
        
        // フォームから送信された_tokenを削除する
        unset($form['_token']);
        // フォームから送信されたimageを削除する
        unset($form['profile-image']);
        
        // データベースに保存する
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile/create');
    }
    
    public function index(Request $request) {
        
        $cond_name = $request->name;
        
        if ($cond_name != '') {
            // 検索されたらその検索結果を表示する
            $posts = Profile::where('title', $cond_name)->get();
        } else {
            // それ以外はすべての一覧を表示する
            $posts = Profile::all();
        }
        
        return view('admin.profile.index',['posts' => $posts, 'cond_name' => $cond_name]);
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
        
        // 「画像を削除」にチェックが入っていた場合
        if ($request->remove == 'true') {
            
            // すでに登録されている画像を削除
            $form['image_path'] = null;
            
        // 画像登録なし→新たに画像が登録された場合
        } else if($request->file('profile-image')) {
            
            // 画像を更新（登録の処理と同じ）
            $path = $request->file('profile-image')->store('public/image');
            $form['image_path'] = basename($path);
        
        // 画像変更なし
        } else {
        
            // 変更なし
            $form['image_path'] = $profile->image_path;
        }
        
        unset($form['profile-image']);
        unset($form['remove']);
        unset($form['_token']);
        
        // 該当するデータを上書きして保存する
        $profile->fill($form)->save();
        
        // インスタンス名＝呼び出すモデル名
        $history = new ProfileHistory();
        // Profile Modelのカラム名とProfileHistory Modelのカラム名を意識する
        $history->profile_id = $profile->id;
        $history->edited_at_profile = Carbon::now();
        $history->save();
        
        // 編集画面をリダイレクト
        return redirect('admin/profile/');
    }
    
    public function delete(Request $request) {
        
        // 削除ボタンが押されたidを探す
        $profile = Profile::find($request->id);
        
        // 削除する
        $profile->delete();
        
        // 編集画面をリダイレクト
        return redirect('admin/profile/');
    }
    
}
