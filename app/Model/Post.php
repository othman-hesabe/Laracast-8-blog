<?php


namespace App\Model;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{
    public static function all()
    {
        $files = File::files(resource_path("posts/"));

        return array_map(function ($file) {
            return $file->getContents();
        }, $files);
    }

    public static function find($slug)
    {
//        base_path();
        if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
            // return redirect('/');
            // abort(404);
            throw new ModelNotFoundException();
        }

        // Cache every 20 mins
        return $post = cache()->remember("posts.{$slug}", now()->addMinutes(20), function () use ($path) {
            return file_get_contents($path);
        });


    }

}
