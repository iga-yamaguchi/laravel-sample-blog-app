@extends('two-column')
@section('main')
    <div class="row">
        <div class="col-sm-12">
            <img src="{{ $article->image_path }}" alt="" class="img-thumbnail">
            <h2>{{ $article->title }}</h2>
            @foreach($article->tags as $tag)
                <a href="{{ route('tag.show', $tag) }}"><span class="label label-info">{{ $tag->name }}</span></a>
            @endforeach
            <p class="text-primary">{{ $article->created_at }}</p>
            {{ $article->content }}
        </div>
    </div>
@endsection