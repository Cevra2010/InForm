@extends("layouts.backend.app")

@section("content")

    <h1 class="backend-headline">
        {{ __("backend.user.roles_overview") }}
    </h1>

    <a href="{{ route("backend.user.roles.create") }}" class="bg-teal-600 hover:bg-teal-700 text-white text-sm p-2 rounded shadow">
        <i class="fa fa-user-plus"></i> Benutzerrolle anlegen
    </a>

    <x-inform-data-table table="roles-table" />
@endsection
