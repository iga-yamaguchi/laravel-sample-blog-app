@extends('one-column')
@section('main')
    <div class="row">
        @foreach($tags as $tag)
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="{{ route('tag.show', $tag) }}"><h3>{{ $tag->name }}</h3></a>
                        <p><a href="{{ route('tag.show', $tag) }}">article counts : {{ $tag->articles->count() }}</a></p>
                        <a href="{{ route('tag.edit', $tag) }}" type="button" class="btn btn-primary">Edit</a>
                        {{ Form::model($tag, ['route' => ['tag.destroy', $tag->id], 'method' => 'DELETE', 'class' => 'form-inline btn']) }}
                        <div class="form-group">
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection