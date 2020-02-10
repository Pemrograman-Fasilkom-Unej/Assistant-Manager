<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait MinioHelper
{
    protected function generateTemporaryUrl($path, $time = 10, $options = [])
    {
        return Storage::disk('minio')->temporaryUrl(
            $path,
            Carbon::now()->addMinutes($time),
            $options
        );
    }

    protected function storeFileMinio($path, UploadedFile $file, $filename = null)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = $filename ?? uniqid();
        $filepath = "$path/$filename.$extension";
        Storage::disk('minio')->put($filepath, $file->get());
        return $filepath;
    }
}