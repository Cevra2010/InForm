@extends("layouts.auth.app")

@push("body_classes","auth-bg")

@section("content")
    <div class="flex w-full h-full items-center justify-center">
        <div class="flex w-1/2 shadow-xl rounded-xl">
            <div class="w-2/5 bg-slate-50 rounded-l-xl p-10 shadow">

                <p class="text-sky-900 text-5xl font-bold dancing mb-2">InForm</p>
                <p class="text-xs text-slate-700 mb-6">Informationsverteilung auf neuem Niveu</p>

                @error('invalid_auth')
                    <p class="text-sm text-red-400 mb-2 ">
                        {{ __('Benutzername und/oder Passwort sind nicht korrekt.') }}
                    </p>
                @enderror

                @livewire("auth.login")

            </div>
            <div class="flex flex-col w-3/5 bg-white items-center justify-center rounded-r-xl shadow">
                <img src="{{ asset("auth-image.jpg") }}" class="w-3/4">
            </div>
        </div>
    </div>
@endsection
