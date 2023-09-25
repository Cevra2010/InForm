<div>
    @if($formUsage)
    <div class="flex">
        <div class="w-1/2">
            <div class="form-group">
                <label for="color">{{ __("form.attributes.color") }}</label>
                <div class="bg-{{ $name }}-{{ $strenght }} @if($strenght >= 500) text-slate-50 @else text-slate-800 @endif w-full rounded p-2">{{ $name }}-{{ $strenght }}</div>
                <input id="color" name="color" type="hidden" value="{{ $name }}-{{ $strenght }}" />
            </div>
        </div>
        <div class="w-1/2  border rounded m-1">
    @else
    <div class="flex">
        <p class="p-1 w-1/2 @if($mode == "hex") bg-indigo-500 @else bg-indigo-400 @endif text-slate-50  text-center cursor-pointer" wire:click="$set('mode','hex')" >Hex</p>
        <p class="p-1 w-1/2 @if($mode == "tailwind") bg-indigo-500 @else bg-indigo-400 @endif text-slate-50 text-center cursor-pointer" wire:click="$set('mode','tailwind')" >Tailwind</p>
    </div>
    @endif

    <hr>
    @if($mode == "hex")
        <input type="color" wire:model.live="hex" class="bg-slate-700 rounded p-2 mt-2">
    @else
        <div class="flex space-x-2 mt-2 h-40">
            <div class="w-1/2 flex flex-col space-y-1 overflow-scroll">
                @foreach(config('colors.color_names') as $configName)
                    <p wire:click="$set('name','{{ $configName }}')" class="w-full  cursor-pointer text-center bg-{{ $configName }}-500">{{ $configName }}</p>
                @endforeach
            </div>
            <div class="w-1/2 flex flex-col space-y-1 overflow-scroll">
                @if($name)
                    @foreach(config('colors.color_nums') as $num)
                        <p wire:click="$set('strenght','{{$num}}')" class="@if($num >= 500) text-slate-50 @else text-slate-800 @endif  cursor-pointer text-center bg-{{ $name }}-{{ $num }}">{{ $num }}</p>
                    @endforeach
                @endif
            </div>
        </div>
    @endif

    @if($formUsage)
        </div>
    </div>
    @endif
</div>
