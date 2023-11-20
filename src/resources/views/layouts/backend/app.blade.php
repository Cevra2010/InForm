@extends("layouts.base.html")

@push("body_classes","bg-slate-50")

@section("body")


    <div class="flex h-full">

        @include("layouts.backend.menu")

        <div class="w-full overflow-scroll">

            <div class="flex items-center w-full shadow bg-white text-slate-600 text-sm top-0 sticky">
                <div class="p-4">
                    {{ __("backend.welcome_back") }} <b>{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</b>
                    <p class="text-xs">
                        <b>{{ __("backend.user.userroles") }}</b>:
                        @foreach(auth()->user()->roles as $role)
                            {{ $role->name }}
                            @if(!$loop->last) |
                            @endif
                        @endforeach
                    </p>
                </div>

                <div class="text-red-800 ml-auto pr-4"><i class="fa fa-power-off"></i> {{ __("auth.logout") }}</div>
            </div>

            <div class="w-full p-6 text-slate-700">
                @yield("content")
            </div>

        </div>
    </div>
@endsection
