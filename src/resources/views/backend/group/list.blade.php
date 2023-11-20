@extends("layouts.backend.app")

@section("content")

    <x-inform-headline title="Gruppenübersicht" icon="people-roof" />

    <x-inform-data-table table="inform-user-groups" />

@endsection
