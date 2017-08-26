@extends('one-column')

@section('main')
    {{ Form::open(['route' => 'tag.store']) }}
    <div class="form-group">
        {{ Form::Label('name', 'Tag name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    {{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
    {{ Form::close() }}
@endsection