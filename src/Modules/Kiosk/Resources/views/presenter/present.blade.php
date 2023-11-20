@extends("layouts.present.html")

@section("body")
    @livewire("presenter",['display' => $display])

    <div class="width: 100%; height:100%; overflow-scroll;">
    @foreach($display->displayObjects as $object)
        <div style="left: {{ $object->pos_x }}px; top: {{ $object->pos_y }}px; position:absolute; width: {{ $object->width}}px; height: {{ $object->height}}px;">
        @if($object->getPlugin())
            @livewire($object->getPlugin($object->plugin_slug)->getViewComponent(),['object' => $object],key('object-'.$object->id))
        @else
            Plugin '{{ $object->plugin_slug}}' nicht gefunden.
        @endif
        </div>
    @endforeach

@endsection
