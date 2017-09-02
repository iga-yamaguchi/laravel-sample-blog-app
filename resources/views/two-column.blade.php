@extends('layout')
@section('content')
    <main class="col-sm-8">
        @yield('main')
    </main>
    <aside class="col-sm-4">
        <ol class="list-group">
            @foreach($yearList as $year => $articles)
                <li class="list-group-item"><a href="{{ route('article.year', $year) }}">{{ $year }}</a></li>
            @endforeach
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
