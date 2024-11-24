<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageConverter extends Model
{
    use HasFactory;

    public static function convertImages($images, $path)
    {


        $convertedImages = [];

        foreach ($images as $image) {
            $fileName = uniqid() . '.webp';
            $imagePath = $path . $fileName;

            $directory = public_path($path);

            // Create the directory if it doesn't exist
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }

            $convertedImagePath = ImageConverter::convertImage($image, $imagePath);

            if ($convertedImagePath) {
                array_push($convertedImages, $convertedImagePath);
            }
        }

        return $convertedImages;
    }

    protected static function convertImage($image, $imagePath)
    {
        $img = Image::make($image->getRealPath());

        // Convert the image to webp format and set quality to 70%
        $img->encode('webp', 70)->save(public_path($imagePath));

        return $imagePath;
    }


    public static function convertSingleImage($image, $path)
    {

        $ext = 'webp';
        $new_name = hexdec(uniqid()) . '-' . time() . '.' . $ext;

        // Get the destination path
        $destinationPath = public_path($path);

        // Create the directory if it doesn't exist
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Set the complete file path
        $destinationFilePath = $destinationPath . '/' . $new_name;

        // Convert and save the image
        $imageConvert = Image::make($image->getRealPath());
        $imageConvert->save($destinationFilePath, 70);

        // Get the complete URL or file path of the converted image
        $completePath = asset($path . $new_name);

        return $completePath;
    }
}
