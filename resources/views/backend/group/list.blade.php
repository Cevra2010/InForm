@extends("layouts.backend.app")

@section("content")

    <h1 class="backend-headline">
        Benutzergruppen
    </h1>


    @hasAccess("group.create")
    <a wire:navigate href="{{ route("backend.group.create") }}" class="bg-teal-600 hover:bg-teal-700 text-white text-sm p-2 rounded shadow">
        <i class="fa fa-user-plus"></i> Benutzergruppe anlegen
    </a>
    @endhasAccess
    
    <div class="backend-panel mt-3">
        <table class="backend-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Badge</th>
                    <th>{{ __("form.created-at") }}</th>
                    <th>{{ __("form.updated-at") }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groups as $group)
                    <tr @hasAccess("group.edit") onclick="window.location.href='{{ route("backend.group.edit",$group) }}'" @endhasAccess>
                        <td>{{ $group->name }}</td>
                        <td>{!! $group->getBadge() !!}</td>
                        <td>{{ $group->created_at->format("d.m.Y") }}</td>
                        <td>{{ $group->updated_at->format("d.m.Y") }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
