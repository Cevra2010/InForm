<div class="w-28">
    <input type="text" name="{{ $name }}" value="{{ $value }}" class="inform-input" data-coloris>
</div>
@push("scripts")
    <link rel="stylesheet" href="{{ moduleAssets("Kiosk",'colorpicker/coloris.css') }}">
    <script src="{{ moduleAssets('Kiosk','colorpicker/coloris.js')}}"></script>
@endpush