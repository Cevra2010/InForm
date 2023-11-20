<div>
    @if($status)
        <a href="#setToggle" wire:click='setInactive("{{ $role->id }}","{{ $area->id }}")'>
            <i class="text-green-600 text-2xl fa fa-toggle-on"></i>
        </a>
    @else
        <a href="#setToggle" wire:click='setActive("{{ $role->id }}","{{ $area->id }}")'>
            <i class="text-red-600 fa text-2xl fa-toggle-off"></i>
        </a>
    @endif
</div>
