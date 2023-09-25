@extends("layouts.present.html")

@section("body")
    @livewire("presenter",['display' => $display])
@endsection
