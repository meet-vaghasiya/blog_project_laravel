@extends('layouts.app')

@section('title', 'contact')


@section('content')

    contatct page

    @can('home.contact')
        <a href="{{ route('secrate') }}">Secrate page</a>
    @endcan

@endsection
