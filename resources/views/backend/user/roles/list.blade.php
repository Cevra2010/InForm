@extends("layouts.backend.app")

@section("content")

    <div class="flex mb-4">
        @hasAccess("user.roles")
        <a href="{{ route("backend.user.user.roles.list") }}">
            <div class="h-20 bg-slate-200 rounded items-center justify-center flex flex-col text-slate-600 px-2 hover:bg-slate-300 hover:cursor-pointer space-y-2">
                <i class="fa fa-scale-balanced"></i>
                <p class="text-sm">Benutzerrollen</p>
            </div>
        </a>
        @endhasAccess
    </div>

    <h1 class="backend-headline">
        Kontenübersicht
    </h1>

    <div class="backend-panel">
        <table class="backend-table">
            <thead>
                <tr>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Benutzername</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr onclick="window.location.href='{{ route("backend.user.show",$user) }}'">
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->username }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
