@extends("layouts.backend.app")

@section("content")
    <x-inform-headline title="{{ auth()->user()->firstname }} {{ auth()->user()->lastname}}" icon="house" />
@endsection