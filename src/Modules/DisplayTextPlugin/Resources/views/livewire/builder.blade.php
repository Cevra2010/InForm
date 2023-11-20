<div>
    <div class="flex space-x-2">
        <div class="w-1/2">
            <p class="inform-label">Schriftgröße</p>
            <input type="text" class="inform-input" wire:model.live='data.font_size'>
        </div>
        <div class="w-1/2">
            <p class="inform-label">Schriftart</p>
            <select class="inform-input" wire:model.live='data.font_family'>
                @foreach(config("displaytextplugin.fonts") as $key => $value)
                    <option style="font-family: '{{ $value}}'" value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <p class="inform-label">Schriftfarbe</p>
    <input type="text" class="inform-input"  wire:model.live.debounce.250ms='data.font_color' data-coloris>
    <div class="inform-toggle-bar">
        <div class="@if($data->bold) inform-toggle-true @else inform-toggle-false @endif" wire:click='$toggle("data.bold")'>
            <b>B</b>
        </div>
        <div class="@if($data->cursive) inform-toggle-true @else inform-toggle-false @endif" wire:click='$toggle("data.cursive")'>
            <i>K</i>
        </div>
        <div class="@if($data->underline) inform-toggle-true @else inform-toggle-false @endif" wire:click='$toggle("data.underline")'>
            <u>U</u>
        </div>
    </div>
</div>