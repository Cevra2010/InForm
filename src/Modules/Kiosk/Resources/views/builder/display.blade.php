@extends("layouts.base.html")

@push("body_classes"," bg-slate-200")

@section("body")
    @vite('Modules/Kiosk/Resources/assets/js/app.js')

    @push("scripts")
    <link rel="stylesheet" href="{{ moduleAssets("Kiosk",'colorpicker/coloris.css') }}">
    <script src="{{ moduleAssets('Kiosk','colorpicker/coloris.js')}}"></script>
    @endpush

    @livewire("kiosk::builder.base",[
        'display' => $display,
    ])
@endsection