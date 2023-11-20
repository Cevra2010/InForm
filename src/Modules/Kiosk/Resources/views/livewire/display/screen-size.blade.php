<div wire:poll.keep-alive.3s class="p-2">
    @if(!$started)
        <p>
        Aktuelle Bildschirmgröße:
            @if($this->display->width)
                {{ $this->display->width }} x {{ $this->display->height }} px
            @else
                Bildschirmgröße nicht ermittelt
            @endif
        </p>
        <button wire:click="calculate" class="bg-teal-600 text-white p-2 rounded shadow mt-4"><i class="fa fa-display"></i> Bildschirmgröße jetzt ermitteln</button>
    @else
        <p>
            Aktuelle Bildschirmgröße:
            @if($this->display->width)
                {{ $this->display->width }} x {{ $this->display->height }} px
            @else
                Bildschirmgröße nicht ermittelt
            @endif
        </p>
        <button class="bg-teal-400 text-white p-2 rounded shadow mt-4"> ...Kalkulieren (Event-ID: {{ $event_id }})</button>
    @endif
</div>
