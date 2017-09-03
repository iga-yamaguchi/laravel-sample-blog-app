@extends('one-column')

@section('main')
    @if(count($errors) > 0)
        <p>Error</p>
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @if(isset($tag))
        {{ Form::model($tag, ['route' => ['tag.update', $tag], 'method' => 'PUT']) }}
    @else
        {{ Form::open(['route' => 'tag.store']) }}
    @endif
    <div class="form-group">
        {{ Form::Label('name', 'Tag name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    {{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
    {{ Form::close() }}
@endsection