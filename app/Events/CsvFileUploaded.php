<?php

namespace App\Events;

use App\Models\File;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CsvFileUploaded
{
   // use Dispatchable, InteractsWithSockets, SerializesModels;
    use Dispatchable, SerializesModels;

    public $file;

    /**
     * Create a new event instance.
     */
    public function __construct(File $file)
    {
        $this->file = $file;
        $this->path = Storage::disk('local')->path($file->path);
    }

}
