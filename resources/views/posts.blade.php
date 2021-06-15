@extends('components.layout')

@section('banner')
    <h1> My Blog</h1>
@endsection

@section('content')
    @foreach ($posts as $post)
        {{--    @dd($loop)--}}
        <article>
            <h1>
                <a href="/posts/{{$post->slug}}">
                    {{$post->title}}
                </a>
            </h1>
            <div>
                {{$post->excerpt}}
            </div>
        </article>
    @endforeach
@endsection
