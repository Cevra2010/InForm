@extends("layouts.backend.app")

@section("content")
    <h1 class="backend-headline">
        Benutzerkonto anlegen
    </h1>

    @include("layouts.backend.error_success")

    <div class="backend-panel">
        <form class="inform-form" action="{{ route("backend.user.store.create-user") }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="firstname">{{ __("form.attributes.firstname") }}</label>
                <input id="firstname" name="firstname" type="text" value="{{ old("firstname") }}" />
            </div>
            <div class="form-group">
                <label for="lastname">{{ __("form.attributes.lastname") }}</label>
                <input id="lastname" name="lastname" type="text" value="{{ old("lastname") }}" />
            </div>
            <div class="form-group">
                <label for="username">{{ __("form.attributes.username") }}</label>
                <input id="username" name="username" type="text" value="{{ old("username") }}" />
            </div>
            <div class="form-group">
                <label for="password">{{ __("form.attributes.password") }}</label>
                <input id="password" name="password" type="password" value="" />
            </div>
            <div class="form-group">
                <label for="password-confirmation">{{ __("form.attributes.password-confirm") }}</label>
                <input id="password-confirmation" name="password_confirmation" type="password" value="" />
            </div>
            <button type="submit">{{ __("form.save_changes") }}</button>
        </form>
    </div>

@endsection
