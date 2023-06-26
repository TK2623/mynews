<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profile;

class ProfileController extends Controller
{
    // Action
    public function index(Request $request) {
        
        // 全てのプロフィール情報を取得する
        $posts = Profile::all();
        
        // if (empty($posts['image_path'])) {
            // はてなの画像
            // $image = secure_asset('storage/image/' . 'aiJXnMOfrfnneKvRtRJ3Xlcip2kLH49laxOSDODM.png');
        // }
        
        return view('profile.index', ['posts' => $posts, 'image_path' => $image]);
    }
    
}
