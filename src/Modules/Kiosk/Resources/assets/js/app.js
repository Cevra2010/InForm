document.addEventListener('livewire:initialized', function () {
    Livewire.dispatch('kiosk-init-builder',{width:window.innerWidth,height:window.innerHeight});
})




