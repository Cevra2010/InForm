@extends("layouts.backend.app")

@section("content")

    <h1 class="backend-headline">
        {{ __("backend.user.roles_overview") }}
    </h1>

    <a href="{{ route("backend.user.roles.create") }}" class="bg-teal-600 hover:bg-teal-700 text-white text-sm p-2 rounded shadow">
        <i class="fa fa-user-plus"></i> Benutzerrolle anlegen
    </a>

    <div class="backend-panel mt-4">
        <table class="backend-table">
            <thead>
                <tr>
                    <th>{{ __("backend.user.role") }}</th>
                    <th>{{ __("form.created-at") }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr onclick="window.location.href='{{ route("backend.user.roles.show",$role) }}'">
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->created_at->format("d.m.Y") }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
