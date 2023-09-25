<div>
    <button wire:click="fullWidth" class="builder-input bg-indigo-600 text-slate-50">
        Auf Bildschirmbreite Strecken
    </button>


    <p  class="builder-headline">Hintergrundfarbe</p>
    @livewire("inform-colorpicker",['color' => $this->getColor('container-bg')])

    <p  class="builder-headline">Schatten</p>
    <hr>
    <div>
        <select class="builder-input" wire:model.live="shadow">
            <option value="0">kein Schatten</option>
            <option value="sm">kleiner Schatten</option>
            <option value="md">mittlerer Schatten</option>
            <option value="lg">großer Schatten</option>
            <option value="xl">sehr großer Schatten</option>
        </select>
    </div>

    <p  class="builder-headline">Abrundung</p>
    <hr>
    <div>
        <select class="builder-input" wire:model.live="rounded">
            <option value="0">keine Abrundung</option>
            <option value="sm">kleine Abrundung</option>
            <option value="md">mittlere Abrundung</option>
            <option value="lg">große Abrundung</option>
            <option value="xl">sehr große Abrundung</option>
        </select>
    </div>

    <p class="builder-headline">Rahmen</p>
    <hr>
    <div>
        <select class="builder-input" wire:model.live="border">
            <option value="0">keine Rahmen</option>
            <option value="1">kleiner Rahmen</option>
            <option value="2">mittlerer Rahmen</option>
            <option value="3">großer Rahmen</option>
            <option value="4">sehr großer Rahmen</option>
        </select>
    </div>
    @if($this->displayObject->data['border'])
        <p>Rahmen Farbe</p>
        @livewire("inform-colorpicker",['color' => $this->getColor('container-border')])
    @endif
</div>
