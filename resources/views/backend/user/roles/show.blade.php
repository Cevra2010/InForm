@extends("layouts.backend.app")

@section("content")
    <h1 class="backend-headline">
        {{ __("backend.user.role") }}: {{ $role->name }}
    </h1>
    <p class="text-xs text-slate-600 mb-4">{{__("backend.user.accounts-in-role")}}: {{ $role->users()->count() }} | {{__("form.created-at")}}: {{ $role->created_at->format("d.m.Y H:i ")}} | {{__("form.updated-at")}}: {{ $role->updated_at->format("d.m.Y H:i") }}


    <div class="backend-panel mt-4">
    @foreach($areas as $parentArea)
        <div class="flex p-2 pl-4 border border-slate-200 bg-slate-100 text-slate-700">
            <div>
                @livewire("backend.user.area-toggle",['area' => $parentArea,'role' => $role])
            </div>

            <div class="pl-4">{{ $parentArea->name }}</div>
        </div>
        @include("backend.user.roles.area-child",['deep' => 1])
    @endforeach
    </div>

    <h1 class="backend-headline-small">Benutzerrolle löschen</h1>
    <div class="backend-panel mt-4">
        @livewire("backend.user.delete-role",['role' => $role])
    </div>
@endsection
