@extends("layouts.backend.app")

@section("content")
    <h1 class="backend-headline">
        Benutzergruppe anlegen
    </h1>

    @include("layouts.backend.error_success")

    <div class="backend-panel">
        <form class="inform-form" action="{{ route("backend.group.store") }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">{{ __("form.attributes.name") }}</label>
                <input id="name" name="name" type="text" value="{{ old("name") }}" />
            </div>
        
            @livewire('inform-colorpicker', ['color' => old('color','slate-700'),'inputName' => 'color'])

            @livewire('inform-iconpicker',['icon' => old('icon',null)])

            <button type="submit">{{ __("form.save_changes") }}</button>
        </form>
    </div>


@endsection
