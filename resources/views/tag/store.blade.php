@extends('one-column')
@section('main')
    @component('alert-success')
    Completed creating {{ $name }}.
    @endcomponent
@endsection
