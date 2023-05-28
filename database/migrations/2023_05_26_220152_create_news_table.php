<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            
            // ニュースのタイトルを保存するカラム
            $table->string('title');
            
            // ニュースの本文を保存するカラム
            $table->string('body');
            
            // 画像のパスを保存するカラム nullableは値が空でも登録できる
            $table->string('image_path')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     // もしnewsというテーブルがあれば削除する
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
