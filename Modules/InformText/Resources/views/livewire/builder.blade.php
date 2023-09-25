<div>
    <p class="builder-headline">Inhalt</p>
    <input type="text" wire:model.debounce.1s.live="text" class="builder-input">
    <p class="builder-headline">Schriftart</p>
    <select wire:model.debounce.1s.live="family" class="builder-input">
        @foreach(config("informtext.fonts") as $font)
            <option>{{ $font }}</option>
        @endforeach
    </select>
    <p class="builder-headline">Fett</p>
    <select wire:model.live="bold" class="builder-input">
        <option value="true">Ja</option>
        <option value="false">Nein</option>
    </select>

    <p class="builder-headline">Kursiv</p>
    <select wire:model.debounce.2s.live="cursiv" class="builder-input">
        <option value="true">Ja</option>
        <option value="false">Nein</option>
    </select>

    <p class="builder-headline">Schriftgröße</p>
    <input type="text" wire:model.debounce.1s.live="size" class="builder-input">

    <p class="builder-headline">Textfarbe</p>
    @livewire("inform-colorpicker",['color' => $this->getColor('text-color')])
</div>
