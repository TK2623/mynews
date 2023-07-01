@extends('layouts.frontprofile')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                
                @foreach($posts as $post)
                    <div class="post">
                        
                        <div class="row">
                            
                            <div class="image-position">                                
                                <div class="image">
                                    
                                    <!--画像がセットされているか確認-->
                                    @if(!isset($post->image_path))
                                        <!--セットされていない場合、はてなの画像を出す-->
                                        <img src="{{ secure_asset('storage/image/' . 'mark_question.png') }}">
                                    @else
                                        <!--画像がセットされている場合-->
                                        {{--secure_asset()「publicディレクトリ」のパスを返す関数。「.」は文字列結合する演算子。ここで画像のフルパスを指定している。--}}
                                        <img src="{{ secure_asset('storage/image/' . $post->image_path) }}">
                                    @endif
                                        
                                </div>
                            </div>
                            
                            <div class="text col-md-6">
                                
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                
                                <div class="name">
                                    {{ Str::limit('名前：' . $post->name, 20) }}
                                </div>
                                
                                <div class="gender">
                                    {{ Str::limit('性別：' . $post->gender, 20) }}
                                </div>
                                
                                <div class="hobby">
                                    {{ Str::limit('趣味：' . $post->hobby, 30) }}
                                </div>
                                
                                <div class="introduction">
                                    {{ Str::limit('自己紹介：' . $post->introduction, 1500) }}
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
                
            </div>
        </div>
        
    </div>
    
    @endsection
    