{{-- layouts/profile.blade.phpを読み込む --}}
@extends('layouts.profile')

{{-- profile.blade.phpの@yield('title')に'ニュース新規作成'を埋め込む --}}
@section('title', 'MyNews')

{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        
        <div class="row">
            
            <div class="col-md-8 mx-auto">
                
                <h2>Myニュース編集画面</h2>
                
                <form action="{{ route('admin.profile.update') }}" method="post" enctype='multipart/form-data'>
                    
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="form-group row">
                        
                        <label class="col-md-2" for="name">氏名</label>
                        
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $form->name }}">
                        </div>
                        
                    </div>
                    
                    <div class="form-group row">
                        
                        <label class="col-md-2" for="gender">性別</label>
                        
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="gender" value="{{ $form->gender }}">
                        </div>
                        
                    </div>
                    
                    <div class="form-group row">
                        
                        <label class="col-md-2" for="hobby">趣味</label>
                        
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="hobby" value="{{ $form->hobby }}">
                        </div>
                        
                    </div>
                    
                    <div class="form-group row">
                        
                        <label class="col-md-2" for="introduction">自己紹介</label>
                        
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="10">{{ $form->introduction }}</textarea>
                        </div>
                        
                    </div>
                    
                    <div class="form-group row">
                        
                        <label class="col-md-2" for="profile-image">プロフィール画像</label>
                        
                        <div class="col-md-10">
                            
                            <input type="file" class="form-control-file" name="profileimage">
                            
                            <div class="form-text text-info">
                                設定中: {{ $form->image_path }}
                            </div>
                            
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                            
                        </div>    
                        
                    </div>
                    
                    <div class="form-group row">
                        
                        <div class="col-md-10">
                            {{-- フォームで送られたidをhidden属性で送信する（ユーザーに値を入力させずに送信する）--}}
                            <input type="hidden" name="id" value="{{ $form->id }}">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                        
                    </div>
                
                </form>
                
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($form->profile_histories != NULL)
                                @foreach ($form->profile_histories as $history)
                                    <li class="list-group-item">{{ $history->edited_at_profile }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
@endsection
