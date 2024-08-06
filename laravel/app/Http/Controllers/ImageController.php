<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadBookImage(Request $request): Array
    {
        $images = $request->file();
        $pathImages = [];
    
        foreach ($images as $name => $file) {

            // Check file type
            if (strpos($name, 'front_image') !== false) {
                $folder = 'front_images';
            } elseif (strpos($name, 'thumbnail') !== false) {
                $folder = 'thumbnails';
            } elseif (strpos($name, 'rear_image') !== false) {
                $folder = 'rear_images';
            } else {
                // If not, skip and don't save
                continue;
            }
    
            // filename structure: slug--typeBookImage.typeFile
            $fileName = $request->slug . '--' . $name . '.' . $file->getClientOriginalExtension();
            
            // save file
            $file->move(public_path("uploads/images/books/{$folder}"), $fileName);
    
            // save path
            $pathImages[$name] = "uploads/images/books/{$folder}/{$fileName}";
        }

        return $pathImages;
    }
}
