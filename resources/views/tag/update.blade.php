@extends('one-column')
@section('main')
    @component('alert-success')
    Completed updating {{ $name }}.
    @endcomponent
@endsection
