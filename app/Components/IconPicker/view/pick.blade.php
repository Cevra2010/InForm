<div>
    <div class="form-group">
        <label for="icon">{{ __("form.attributes.icon") }}</label>
        <div class="rounded p-2">
            @if($icon)
                <i class="fa fa-{{ $icon }}"></i>
            @else
                kein Icon
            @endif
        </div>
        <input id="icon" name="icon" type="hidden" value="{{ $icon }}" />
    </div>

    <div class="grid grid-cols-12 gap-1">
        <div class="p-2 bg-slate-100 rounded hover:bg-slate-200 cursor-pointer text-center" wire:click="setIcon('null')">ohne Icon</div>
    @foreach(config("icons.icon-list") as $iconItem)
        <div class="p-2 bg-slate-100 rounded hover:bg-slate-200 cursor-pointer text-center" wire:click='setIcon("{{ $iconItem }}")'><i class="fa fa-{{ $iconItem }}"></i></div>
    @endforeach
    </div>
</div>