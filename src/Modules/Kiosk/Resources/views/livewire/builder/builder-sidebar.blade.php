<div>
    @if($selectedObject && $selectedObject->getPlugin())
        @include("kiosk::livewire.builder.sidebar.object-edit")
    @elseif(!$selectedObject)
       @include("kiosk::livewire.builder.sidebar.object-list")
    @else
        @include("kiosk::livewire.builder.sidebar.object-error")
    @endif
</div>