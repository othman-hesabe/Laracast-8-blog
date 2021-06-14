<?php


namespace App\Model;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{
    public $title;

    public $excerpt;

    public $date;

    public $body;

    public $slug;

    /**
     * Post constructor.
     * @param $title
     * @param $excerpt
     * @param $data
     * @param $body
     */
    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all()
    {
        return cache()->rememberForever('posts.all', function () {
            return collect(File::files(resource_path("posts")))
                ->map(function ($file) {

                    return \Spatie\YamlFrontMatter\YamlFrontMatter::parseFile($file);

                })
                ->map(function ($document) {
                    return new Post(
                        $document->title,
                        $document->excerpt,
                        $document->date,
                        $document->body(),
                        $document->slug
                    );
                })->sortByDesc('date');
        });

    }

    public static function find($slug)
    {
        return static::all()->firstWhere('slug', $slug);

    }

}
