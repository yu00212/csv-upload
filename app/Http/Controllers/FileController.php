<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Row;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Events\CsvFileUploaded;

class FileController extends Controller
{
    public function index()
    {
        // Fileモデルに登録されたCSVファイルを全て取得
        $files = File::where('name', 'like', '%.csv')->get();

        return view('home', compact('files'));
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

        // Fileモデルを作成し、DBにファイルの情報を保存
        $file = new File();
        $file->name = $files->getClientOriginalName();
        $file->path = $path;
        $file->save();

        // イベントをディスパッチ（発行）
        CsvFileUploaded::dispatch($file);

        Log::info('CSVアップロード処理が正常に完了しました。');

        return back()->with('success', 'CSVファイルをアップロードしました。');
    }
}
