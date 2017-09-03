@extends('one-column')
@section('main')
    @include('error')
    @if(isset($article))
        {{ Form::model($article, ['route' => ['article.update', $article->id], 'method' => 'PUT', 'files' => true]) }}
    @else
        {{ Form::open(['route' => 'article.store']) }}
    @endif
    <div class="form-group">
        {{ Form::Label('title', 'Title') }}
        {{ Form::text('title', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::Label('content', 'Content') }}
        {{ Form::textarea('content', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        @foreach($tags as $tag)
            {{ Form::checkbox('tag_id[]', $tag->id, false, ['id' => 'tag-' . $tag->id]) }}
            {{ Form::Label('tag-' . $tag->id, $tag->name) }}
        @endforeach
    </div>
    <div class="form-group">
        {{ Form::Label('image', 'Image') }}
        {{ Form::file('image') }}
    </div>


    {{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
    {{ Form::close() }}
@endsection