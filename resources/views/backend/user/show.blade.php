@extends("layouts.backend.app")

@section("content")
    <h1 class="backend-headline">
        {{ __("backend.user.account") }}: {{ $user->firstname }} {{ $user->lastname }}
    </h1>

    @include("layouts.backend.error_success")

    @hasAccess("user.edit.data")
    <h3 class="backend-headline-small">{{ __("backend.user.base") }}</h3>
    <div class="backend-panel">
        <form class="inform-form" action="{{ route("backend.user.store.data",$user) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="firstname">{{ __("form.attributes.firstname") }}</label>
                <input id="firstname" name="firstname" type="text" value="{{ old("firstname",$user->firstname) }}" />
            </div>
            <div class="form-group">
                <label for="lastname">{{ __("form.attributes.lastname") }}</label>
                <input id="lastname" name="lastname" type="text" value="{{ old("lastname",$user->lastname) }}" />
            </div>
            <div class="form-group">
                <label for="username">{{ __("form.attributes.username") }}</label>
                <input id="username" name="username" type="text" value="{{ old("username",$user->username) }}" />
            </div>
            <button type="submit">{{ __("form.save_changes") }}</button>
        </form>
    </div>
    @endhasAccess

    @hasAccess("user.edit.password")
    <h3 class="backend-headline-small">{{ __("backend.user.change-password") }}</h3>
    <div class="backend-panel p-4">
        <form class="inform-form" action="{{ route("backend.user.store.password",$user) }}" method="POST">
            @csrf
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
    @endhasAccess

    @hasAccess("user.edit.roles")
    <h3 class="backend-headline-small">{{ __("backend.user.userroles") }}</h3>
    <div class="backend-panel p-4">
        @livewire("backend.user.role-selector",['user' => $user])
    </div>
    @endhasAccess

    @hasAccess("user.edit.delete")
        <h3 class="backend-headline-small">{{ __("backend.user.delete-user") }}</h3>
        <div class="backend-panel p-4">
            <p class="text-slate-500 mb-4">
                Um ein versehentliches Löschen zu vermeiden, geben Sie bitte vor dem Löschen den untenstehenden Sicherheitsschlüssel ein.
            </p>
            <div class="w-full bg-slate-200 text-slate-500 text-lg font-semibold p-2 rounded mb-4">
                {{ $deleteKey }}
            </div>
            <form action="{{ route("backend.user.delete",$user) }}" method="POST" class="inform-form">
                @csrf
                <div class="form-group">
                    <label for="deleteKey">Sicherheitsabfrage</label>
                    <input type="text" name="deleteKey" id="deleteKey" value="">
                </div>

                <button type="submit">Benutzerrolle löschen</button>
            </form>
        </div>
    @endhasAccess
@endsection
