<div class="flex w-full justify-center items-center bg-slate-100 rounded mb-4">
    <div class="px-6 text-slate-500 ">
        <i class="fa fa-magnifying-glass"></i>
    </div>
    <input type="text" wire:model.live.debounce.500ms='searchQuery' class="w-full border-none p-2 bg-slate-100 outline-none text-sm" placeholder="Suchen...">
</div>