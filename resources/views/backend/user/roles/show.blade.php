@extends("layouts.backend.app")

@section("content")
    <h1 class="backend-headline">
        {{ __("backend.user.account") }}: {{ $user->firstname }} {{ $user->lastname }}
    </h1>


    @hasAccess("user.edit.data")
    <h3 class="backend-headline-small">{{ __("backend.user.base") }}</h3>
    <div class="backend-panel">
        @include("layouts.backend.error_success")
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

    @hasAccess("user.edit.roles")
    <h3 class="backend-headline-small">{{ __("backend.user.userroles") }}</h3>
    <div class="backend-panel p-4">
        @livewire("backend.user.role-selector",['user' => $user])
    </div>
    @endhasAccess
@endsection
