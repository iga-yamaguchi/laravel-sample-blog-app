@extends('layout')
@section('content')
    @foreach($articles as $article)
        <div class="row">
            <div class="col-sm-12">
                <div class="thumbnail">
                    <a href="#"><img src="{{ $article->image_path }}" alt="..."></a>
                    <div class="caption">
                        <a href="#"><h3>{{ $article->title }}</h3></a>
                        @foreach($article->tags as $tag)
                            <a href="{{ route('tag.show', $tag) }}"><span class="label label-info">{{ $tag->name }}</span></a>
                        @endforeach
                        <p class="text-primary">{{ $article->created_at }}</p>
                        <p class="lead">{{ $article->content }}</p>
                        <p class="text-right"><a href="#" class="btn btn-default" role="button">More</a></p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
