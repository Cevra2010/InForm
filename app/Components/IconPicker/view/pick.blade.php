<div>
    <div x-data="{openColorPicker: false}">
        <div class="form-group">
            <label for="icon">{{ __("form.attributes.icon") }}</label>
            <a href="#" @click="openColorPicker = ! openColorPicker">
            <div class="rounded p-2 bg-slate-200 hover:bg-slate-300">
                @if($icon)
                    <i class="fa fa-{{ $icon }}"></i>
                @else
                    kein Icon
                @endif
            </div>
            </a>
            <input id="icon" name="icon" type="hidden" value="{{ $icon }}" />
        </div>
        <div x-show="openColorPicker" class="position-absolute absolute p-2 rounded border bg-slate-50 h-60 w-60 overflow-y-scroll">
            <a href="#" @click="openColorPicker = false">
            <div class="fixed p-1 flex rounded bg-teal-500 text-white">
                <i class="fa fa-close"></i>
            </div>  
            </a>
            <div class="grid grid-cols-5 gap-1 mt-8 p-1">
                <div class="py-1 bg-slate-100 rounded hover:bg-slate-200 cursor-pointer text-center" @click="openColorPicker = false" wire:click="setIcon('null')">{{ __("icon.no-icon")}}</div>
                @foreach(config("icons.icon-list") as $iconItem)
                    <div class="py-1 @if($icon == $iconItem) bg-yellow-300 hover:bg-yellow-300 @else bg-slate-100 hover:bg-slate-200 @endif rounded cursor-pointer text-center" @click="openColorPicker = false" wire:click='setIcon("{{ $iconItem }}")'><i class="fa fa-{{ $iconItem }}"></i></div>
                @endforeach
            </div>
        </div>
    </div>
</div>