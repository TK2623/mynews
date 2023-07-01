<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\News;

class NewsController extends Controller
{
    // Action
    public function index(Request $request) {
        // 全ての記事を投稿日時順に新しいほうから並べ替える
        $posts = News::all()->sortByDesc('updated_at');
        
        // 記事が1以上あったら
        if (count($posts) > 0) {
            
            // shift()メソッドは、配列の最初のデータを削除し、その値を返す。配列を左にシフトする
            // $headline に最新の記事を代入。$postsに最新以外の記事が格納される。最新の記事とそれ以外の記事の表記を変えたい。
            $headline = $posts->shift();
            
        } else {
            $headline = null;
        }
        
        // news/index.blade.php ファイルに渡している
        // また View テンプレートに headline、posts、という変数を渡している
        return view('news.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
