@extends("layouts.backend.app")

@section("content")
    <x-inform-headline title="Kontenübersicht" icon="users" />
    <x-inform-data-table table="users-table" />
@endsection
