<?php

namespace App\Listeners;

use App\Events\CsvFileUploaded;
use App\Models\File;
use App\Models\Row;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CsvFileUploadedListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(File $file)
    {
        $this->file = $file;
        $this->path = Storage::disk('local')->path($file->path);
    }

    /**
     * Handle the event.
     */
    public function handle(CsvFileUploaded $event): void
    {
        Log::info('CSVカラムのレコード登録処理を実行します。');

        // CSVファイルを読み込んで登録処理を実行する
        $csvData = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($csvData as $line)
        {
            // CSVの各項目を配列に格納する
            $data = str_getcsv($line);

            // データベースに登録
            $row = new Row;
            $row->representative_name = $data[0];
            $row->representative_name_kana = $data[1];
            $row->company_name = $data[2];
            $row->company_name_kana = $data[3];
            $row->business_content = $data[4] ?? null;
            $row->established_at = $data[5] ? date('Y-m-d', strtotime($data[5])) : null;
            $row->file_id = $this->file->id;
            $row->save();
            Log::info('CSVカラムのレコード登録処理が完了しました。');
        }
    }
}
