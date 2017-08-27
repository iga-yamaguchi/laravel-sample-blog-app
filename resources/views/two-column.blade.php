@extends('layout')
@section('content')
    <main class="col-sm-8">
        @yield('main')
    </main>
    <aside class="col-sm-4">
        <ol class="list-group">
            @for($i = 2017; $i >= 2000; $i--)
                <li class="list-group-item">{{ $i }}</li>
            @endfor
        </ol>
        <ul class="list-inline">
            @foreach($tags as $tag)
                <li class="">
                    <a href="{{ route('tag.show', $tag) }}"><span class="label label-default">{{ $tag->name }}</span></a>
                </li>
            @endforeach
        </ul>
    </aside>
@endsection
