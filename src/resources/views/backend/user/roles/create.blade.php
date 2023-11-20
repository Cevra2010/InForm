@extends("layouts.backend.app")

@section("content")
    <h1 class="backend-headline">
        Benutzerrolle anlegen
    </h1>

    @include("layouts.backend.error_success")

    <div class="backend-panel">
        <form class="inform-form" action="{{ route("backend.user.roles.store") }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">{{ __("backend.user.role") }}</label>
                <input id="name" name="name" type="text" value="{{ old("role") }}" />
            </div>
            <button type="submit">{{ __("form.save_changes") }}</button>
        </form>
    </div>

@endsection
