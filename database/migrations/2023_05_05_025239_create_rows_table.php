<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * CSVファイルの各行のデータを保存するテーブル
     */
    public function up(): void
    {
        Schema::create('rows', function (Blueprint $table) {
            $table->id();
            $table->integer('file_id')->comment('行が属するファイルのID');
            $table->string('representative_name')->comment('代表者名');
            $table->string('representative_name_kana')->comment('代表者名(カナ)');
            $table->string('company_name')->comment('法人名');
            $table->string('company_name_kana')->comment('法人名(カナ)');
            $table->text('business_content')->nullable()->comment('事業内容');
            $table->date('established_at')->nullable()->comment('設立年月日');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rows');
    }
};
