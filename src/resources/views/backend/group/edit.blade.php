@extends("layouts.backend.app")

@section("content")
    <h1 class="backend-headline">
        Benutzergruppe bearbeiten
    </h1>

    @include("layouts.backend.error_success")

    <div class="backend-panel">
        <form class="inform-form" action="{{ route("backend.group.update",['group' => $group]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">{{ __("form.attributes.name") }}</label>
                <input id="name" name="name" type="text" value="{{ old("name",$group->name) }}" />
            </div>
        
            <div class="form-group">
                <label for="name">{{ __("form.attributes.color") }}</label>
                <x-inform-colorpicker name="color" value="{{ old('color',$group->color)}}" />
            </div>

            @livewire('inform-iconpicker',['icon' => old('icon',$group->icon)])

            <button type="submit">{{ __("form.save_changes") }}</button>
        </form>
    </div>


@endsection
