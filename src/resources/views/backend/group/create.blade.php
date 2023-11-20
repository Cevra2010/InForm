@extends("layouts.backend.app")

@section("content")

    <x-inform-headline title="Gruppe erstellen" icon="people-group" />

    @include("layouts.backend.error_success")

    <div class="backend-panel">

        <p class="text-sm text-slate-700 pl-2 pb-4">
            Erstellen Sie Gruppen um die Konten Ihrer Mitarbeiter logisch zu Gruppieren. <br />Jeder Mitarbeiter kann Mitglied mehrer Gruppen sein.
        </p>

        <form class="inform-form" action="{{ route("backend.group.store") }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">{{ __("form.attributes.name") }}</label>
                <input id="name" name="name" type="text" value="{{ old("name") }}" />
            </div>
        
            <div class="form-group">
                <label for="name">{{ __("form.attributes.color") }}</label>
                <x-inform-color-picker name="color" value="{{ old('color','#cecece')}}" />
            </div>

            @livewire('inform-iconpicker',['icon' => old('icon',null)])

            <button type="submit">{{ __("form.save_changes") }}</button>
        </form>
    </div>


@endsection
