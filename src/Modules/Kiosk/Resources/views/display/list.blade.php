@extends("layouts.backend.app")

@section("content")
    <x-inform-headline title="Bildschirmübersicht" icon="display" />
    <x-inform-data-table table="kiosk-displays-data-table" />
@endsection
