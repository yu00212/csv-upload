<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * CSVファイルのインポートを非同期に処理するために使用するキューに関連するテーブル
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id(); // 自動採番されるファイルID
            $table->string('queue')->comment('どのキューにジョブが格納されているかを示す');
            $table->text('payload')->comment('ジョブが実行されるときに必要なすべての情報');
            $table->unsignedTinyInteger('attempts')->default(0)->comment('ジョブの実行に失敗した場合、そのジョブが再試行された回数を示す数値');
            $table->timestamp('reserved_at')->nullable()->comment('ジョブが実行される予定の時刻を示す');
            $table->timestamp('available_at')->useCurrent()->comment('ジョブがキューに格納された時刻を示す');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
