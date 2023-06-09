{{-- layouts/profile.blade.phpを読み込む --}}
@extends('layouts.profile')

{{-- profile.blade.phpの@yield('title')に'ニュース新規作成'を埋め込む --}}
@section('title', 'My プロフィール')

{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        
        <div class="row">
            
            <div class="col-md-8 mx-auto">
                
                <h2>My プロフィール</h2>
                
                <form action="{{ route('admin.profile.create') }}" method="post" enctype="multipart/form-data">
                    
                    @if (count($errors) > 0)
                        <ul>
                            {{-- エラーの数だけループし配列$eに格納する --}}
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="form-group row">
                        
                        <label class="col-md-2">氏名</label>
                        
                        <div class="col-md-10">
                            {{-- old('変数名')は　入力フォームから送信をした際、エラーなどで最初の入力フォームに戻されたときに --}}
                            {{-- 入力内容をそのまま「自動で入れなおしてあげる機能」--}}
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                        
                    </div>
                    
                    <div class="form-group row">
                    
                        <label class="col-md-2">性別</label>
                        
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="gender" value="{{ old('gender') }}">
                        </div>
                    
                    </div>
                    
                    <div class="form-group row">
                        
                        <label class="col-md-2">趣味</label>
                        
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="hobby" value="{{ old('hobby') }}">
                        </div>
                    
                    </div>
                    
                    <div class="form-group row">
                        
                        <label class="col-md-2">自己紹介</label>
                        
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="10">{{ old('introduction') }}</textarea>
                        </div>
                    
                    </div>
                    
                    <div class="form-group row">
                        
                        <label class="col-md-2">プロフィール画像</label>
                        
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="profileimage">
                        </div>
                    
                    </div>
                    
                    @csrf
                    <input type="submit" class="btn btn-primary" value="新規作成">
                    
                </form>
                
            </div>
            
        </div>
        
    </div>
@endsection
