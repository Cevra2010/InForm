@extends("layouts.backend.app")

@section("content")
    <x-inform-headline title="Newsfeed Einstellungen" icon="newspaper" />
    <x-inform-panel>
        @include("layouts.backend.error_success")
        <form class="inform-form" action="{{ route("newsfeed::update-settings",$newsfeed) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">{{ __("form.attributes.name") }}</label>
                <input id="name" name="name" type="text" value="{{ old("name",$newsfeed->name) }}" />
            </div>
            <div class="form-group">
                <label for="group-selector">Lesen</label>
                <div>
                    @livewire("form.group-selector",['target' => 'newsfeed_read','targetId' => $newsfeed->id,'firstActionName' => 'Alle'])
                </div>
            </div>
            <div class="form-group">
                <label for="group-selector">Schreiben</label>
                <div>
                    @livewire("form.group-selector",['target' => 'newsfeed_write','targetId' => $newsfeed->id,'firstActionName' => 'Keine'])
                </div>
            </div>
            <div class="form-group">
                <label for="group-selector">Veröffentlichen</label>
                <div>
                    @livewire("form.group-selector",['target' => 'newsfeed_publish','targetId' => $newsfeed->id,'firstActionName' => 'Keine'])
                </div>
            </div>
            <button type="submit">{{ __("form.save_changes") }}</button>
        </form>
    </x-inform-panel>
@endsection