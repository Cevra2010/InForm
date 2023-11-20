<div wire:poll.keep-alive.3s>
    <script>
        Livewire.on('calculate-screen-size', eventId => {
            Livewire.dispatch('calculate-screen-size-result',{eventid:eventId,width:window.innerWidth,height:window.innerHeight});
        })
    </script>
</div>
