@extends("layouts.base.html")

@section("title","Kiosk")

@section("body")
<div class="h-screen w-screen bg-home">
    <div class="bg-bf h-20">
        <div class="flex h-full items-center">
            <div class="flex pl-4">
                <img src="{{ asset("svg/logo-bf-white.svg") }}" class="w-40">
            </div>
        </div>
    </div>
    @yield("content")
</div>
@endsection
