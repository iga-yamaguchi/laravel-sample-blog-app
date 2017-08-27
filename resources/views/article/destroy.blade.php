@extends('one-column')
@section('main')
    @component('alert-success')
    Completed deleting {{ $title }}.
    @endcomponent
@endsection
