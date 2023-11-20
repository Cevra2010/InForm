@extends("layouts.backend.app")

@section("content")

    <h1 class="backend-headline">
        <i class="fa fa-display"></i> Bildschirmübersicht
    </h1>

    @hasAccess("display.edit.create")
    <a href="{{ route("backend.display.create") }}" class="bg-teal-600 hover:bg-teal-700 text-white text-sm p-2 rounded shadow">
        <i class="fa fa-plus-circle"></i> Bildschirm anlegen
    </a>
    @endaccess

    <div class="backend-panel mt-3">
        <table class="backend-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Breite</th>
                    <th>Höhe</th>
                    <th>{{ __("form.created-at") }}</th>
                    <th>{{ __("form.updated-at") }}</th>
                    <th>Online</th>
                </tr>
            </thead>
            <tbody>
                @foreach($displays as $display)
                    <tr onclick="window.location.href='{{ route("backend.display.edit",$display) }}'">
                        <td>{{ $display->name }}</td>
                        <td>{{ $display->width }} px</td>
                        <td>{{ $display->height }} px</td>
                        <td>{{ $display->created_at->format("d.m.Y") }}</td>
                        <td>{{ $display->updated_at->format("d.m.Y") }}</td>
                        <td>
                            @livewire("kiosk::display.online-state",['display' => $display])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
