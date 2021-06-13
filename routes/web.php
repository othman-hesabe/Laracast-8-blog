<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use  App\Model\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// test comment
Route::get('/', function () {
    $files = File::files(resource_path("posts"));

    $posts = collect($files)
        ->map(function ($file) {
            $document = \Spatie\YamlFrontMatter\YamlFrontMatter::parseFile($file);;
            return new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug
            );
        });

    $posts = array_map(function ($file) {
        $document = \Spatie\YamlFrontMatter\YamlFrontMatter::parseFile($file);;
        return new Post(
            $document->title,
            $document->excerpt,
            $document->date,
            $document->body(),
            $document->slug
        );
    }, $files);


    return view('posts', [
        'posts' => $posts
    ]);

});

Route::get('/posts/{post}', function ($slug) {
    return view('post', [
        'post' => \App\Model\Post::find($slug)
    ]);
})->where('post', '[A-z_\-]+');
