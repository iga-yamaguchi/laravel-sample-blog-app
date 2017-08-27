@extends('one-column')
@section('main')
    {{ Form::open(['route' => 'article.store']) }}
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