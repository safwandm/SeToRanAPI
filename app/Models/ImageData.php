<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageData extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_gambar';
    protected $fillable = [
        'data',
        'label'
    ];

    // kali aja mau dipake di bagian lain
    static function storeImage($file, $label) {

        // Convert the image to binary data
        $binaryData = file_get_contents($file->getRealPath());

        // Create a new ImageData instance
        $imageData = new ImageData();
        $imageData->data = $binaryData;
        $imageData->label = $label;

        // Save the image data to the database
        $imageData->save();

        return $imageData->id_gambar;
    }
}
