@extends("layouts.backend.app")

@section("content")
@include("layouts.backend.error_success")


<x-inform-headline title="Newsfeed erstellen" icon="plus" />
<x-inform-panel>
    <form class="inform-form" action="{{ route("newsfeed::add-newsfeed.store") }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">{{ __("form.attributes.name") }}</label>
            <input id="name" name="name" type="text" value="{{ old("name") }}" />
        </div>
        <button type="submit">{{ __("form.save_changes")}}</button>
    </form>
</x-inform-panel>
@endsection