<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Events\CsvFileUploaded;

class FileController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        $files = $request->file('csv_file');

        Log::info('CSVアップロード処理を実行します。');

        // CSVファイルがアップロードされていない場合はエラーを返す
        if(!$files) {
            Log::info('CSVアップロードに失敗しました。');
            return back()->withErrors(['csv_files' => 'CSVファイルがアップロードされていません。']);
        }

        // CSVファイルを一時ファイルとして保存
        $path = $files->store('csv', 'local');

        // CSVファイルがアップロードされたことを通知するイベントを発行
        event(new CsvFileUploaded($path));


    }
}
