<?php

namespace App\Events;

use App\Models\File;
use App\Models\Row;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CsvFileUploaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $path;
    public $file;

    /**
     * Create a new event instance.
     */
    public function __construct(File $file)
    {
        $this->file = $file;
        $this->path = Storage::disk('local')->path($file->path);
    }

    public function handle()
    {
        // CSVファイルを読み込んで登録処理を実行する
        $csvData = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($csvData as $line)
        {
            // CSVの各項目を配列に格納する
            $data = str_getcsv($line);

            // データベースに登録
            $row = new Row;
            $row->representative_name = $data[0];
            $row->company_name = $data[1];
            $row->company_name_kana = $data[2];
            $row->business_content = $data[3] ?? null;
            $row->established_at = $data[4] ? date('Y-m-d', strtotime($data[4])) : null;
            $row->file_id = $this->file->id;
            $row->save();
        }

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
