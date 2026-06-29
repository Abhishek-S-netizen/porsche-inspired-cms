<?php

namespace App\Helpers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CloudinaryHelper
{
    public static function upload($file, $folder = null)
    {
        if (!$file) {
            return null;
        }

        $upload = Cloudinary::uploadApi()->upload($file->getRealPath(), [
            'folder' => $folder ?? 'default'
        ]);

        return [
            'url' => $upload["secure_url"],
            'public_id' => $upload["public_id"],
        ];
    }

    public static function delete($publicId) {
        if (!$publicId) {
            return;
        }

        Cloudinary::uploadApi()->destroy($publicId);
    }
}