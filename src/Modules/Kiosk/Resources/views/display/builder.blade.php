@extends("layouts.base.html")

@push("body_classes"," bg-slate-200")


@section("body")

    @livewire("backend.display.display-builder.builder",['display' => $display])
@endsection
