<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class FileHelper
{
    

    /**
     * Generate a unique file path for a given file suffix
     *
     * @param string $suffix The suffix of the file
     * 
     * @return array A key-value pair containing the file directory, file name and file path
     * 
     * The file path is generated by combining a random string, the current timestamp, and the file suffix.
     * The file directory is the same as the file suffix.
     * The file name is a combination of the suffix, a random string, and the current timestamp.
     */
   public static function createFilePath(string $suffix)
   {
    $randomString = Str::random(10);

    $timestamp = now()->timestamp;

    $fileName = $suffix."-{$randomString}-{$timestamp}.json";
    $fileDirectory = $suffix;

    $filePath = $fileDirectory."/".$fileName;
    
    return [
        "file_directory" => $fileDirectory,
        "file_name" => $fileName,
        "file_path" => $filePath
    ];
   }
}