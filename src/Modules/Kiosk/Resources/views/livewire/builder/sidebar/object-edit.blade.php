<div class="bg-white rounded border mb-4 w-96 text-slate-800">
    <div class="w-full p-2 border-b bg-slate-50 rounded-t font-bold">
        <div class="flex w-full justify-between items-center">
            <div>
                <i class="fa fa-{{ $selectedObject->getPlugin()->getIcon() }}"></i> {{ $selectedObject->getPlugin()->getName() }} <span class="text-xs">[#{{ $selectedObject->id}}]</span>
                <p class="text-xs">Plugin-Einstellungen</p>
            </div>
            <div class="pr-2 text-teal-600 hover:text-teal-800">
                <button wire:click='setSelectedObjectToNull'><i class="fa fa-circle-xmark"></i></button>
            </div>
        </div>
    </div>
    <div class="p-2">
        <div class="w-full bg-slate-100 mb-2">
            <div class="border-b text-xs flex w-full justify-between items-center">
                <div>
                    <p class="p-2">Container-Grundeinstellungen</p>
                </div>
                <div class="p-2">
                    <button class="bg-slate-400 hover:bg-red-700 text-white p-1 rounded text-xs" wire:click='deleteObject'><i class="fa fa-trash"></i></button>
                </div>
            </div>
            <input type="text" class="inform-input" wire:model.live.debounce.500ms='selectedObjectName'>
        </div>

        <div class="w-full bg-slate-100">
            <div class="border-b text-xs flex w-full justify-between items-center">
                <div>
                    <p class="p-2">Containerspzifische Einstellungen</p>
                </div>
            </div>
            <div class="p-2">
                @livewire($selectedObject->getPlugin()->getBuilderComponent(),['key' => '$selectedObject->id','object' => $selectedObject])
            </div>
        </div>
    </div>
</div>