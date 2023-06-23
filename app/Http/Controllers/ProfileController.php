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
        
        return view('profile.index', ['posts' => $posts]);
    }
    
}
