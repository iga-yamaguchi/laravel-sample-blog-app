@extends('one-column')
@section('main')
    @if(isset($article))
        {{ Form::model($article, ['route' => ['article.update', $article->id], 'method' => 'PUT']) }}
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
    {{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
    {{ Form::close() }}
@endsection