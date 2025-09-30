<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Show the gallery page.
     */
    public function index()
    {
    // Read images from public/gallery/labubu (user requested subfolder)
    $subfolder = 'labubu';
    $galleryPath = public_path('gallery' . DIRECTORY_SEPARATOR . $subfolder);
        $images = collect();

        if (is_dir($galleryPath)) {
            $files = array_values(array_filter(scandir($galleryPath), function ($f) {
                return $f !== '.' && $f !== '..' && preg_match('/\.(jpe?g|png|gif|webp)$/i', $f);
            }));

            // Natural sort so filenames like img2.jpg come before img10.jpg
            natsort($files);
            $files = array_values($files);

            foreach ($files as $file) {
                // Use asset() so the URLs respect the APP_URL / subdirectory if any.
                $images->push(asset('gallery/' . $subfolder . '/' . $file));
            }
        }

        // No placeholder fallback: assume real images live in public/gallery
        // If there are no images, the view will render an empty gallery.

        return view('gallery', ['images' => $images]);
    }
}
