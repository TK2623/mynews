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
        //Schema::create('テーブル名',[Blueprintオブジェクトを受け取るクロージャ関数])
        Schema::create('profile_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('profile_id');
            $table->string('edited_at_profile');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //指定したテーブルがあれば削除して、なければ何もしない（エラーを返さない）というメソッド
        Schema::dropIfExists('profile_histories');
    }
};
