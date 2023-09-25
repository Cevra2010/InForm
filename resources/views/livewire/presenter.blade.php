<div wire:poll.keep-alive.3s style="position: absolute; width: 100%; height: 100%; overflow: hidden;">
    @foreach($displayObjects as $object)
        <div wire:key="object-{{ $object->id }}" style="width: {{ $object->width }}px; height: {{ $object->height }}px; top: {{ $object->pos_y }}px; left: {{ $object->pos_x }}px; position: absolute; z-index:{{ $object->zindex }};">
            @livewire($object->getModule()->getBuilderViewComponent(),['object' => $object],key('object-'.$object->id))
        </div>
    @endforeach

    <script>
        Livewire.on('calculate-screen-size', eventId => {
            Livewire.dispatch('calculate-screen-size-result',{eventid:eventId,width:window.innerWidth,height:window.innerHeight});
        })
    </script>
</div>
