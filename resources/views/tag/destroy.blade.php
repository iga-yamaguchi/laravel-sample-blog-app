@extends('one-column')
@section('main')
    @component('alert-success')
    Completed deleting {{ $name }}.
    @endcomponent
@endsection
