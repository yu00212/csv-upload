<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * CSVファイルのメタデータを保存するテーブル
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id(); // 自動採番されるファイルID
            $table->integer('user_id')->comment('ファイルをアップロードしたユーザーのID');
            $table->string('name')->comment('ファイル名');
            $table->string('path')->comment('ファイルの保存先パス');
            $table->integer('size')->comment('ファイルサイズ');
            $table->string('mime_type')->comment('ファイルにMIMEタイプ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
