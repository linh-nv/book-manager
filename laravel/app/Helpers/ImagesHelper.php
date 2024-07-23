<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Upload image
 * @param mixed $file
 * @param string $path
 * @return string
 */
if (!function_exists('uploadImage')) {
    function uploadImage(mixed $file, string $path = "upload"): string
    {
        $extension = $file->getClientOriginalExtension();
        $fileContent = file_get_contents($file->getPathname());
        $fileName = 'media_' . md5($fileContent);
        $file->storeAs($path, $fileName . '.' . $extension, 'public');
        $uploadedImagePath = $path . '/' . $fileName . '.' . $extension;

        return $uploadedImagePath;
    }
}

/**
 * @param mixed $file
 * @param string $path : default is 'upload'
 * @param string|null $oldPath
 * @return string
 */
if (!function_exists('updateImage')) {
    function updateImage(mixed $file, string $oldPath = null): string
    {
        deleteImage($oldPath);
        return uploadImage($file);
    }
}

/** Handle Delete File
 * @param string $path
 * @return void
 */
if (!function_exists('deleteImage')) {
    function deleteImage(string $path): void
    {
        $file_exists = Storage::disk('public')->exists($path);
        
        if ($file_exists) {
            Storage::disk('public')->delete($path);
        }
    }
    
}