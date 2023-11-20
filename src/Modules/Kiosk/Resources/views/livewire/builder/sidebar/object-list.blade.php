<div class="bg-white rounded border mb-4 w-96">
    <div class="w-full p-2 border-b bg-slate-50 rounded-t font-bold">
        <i class="fa fa-puzzle-piece"></i> verwendete Plugins
    </div>
    <div  class="p-2">
        @foreach($displayObjects as $object)
            @if(!isset($deletedObjects[$object->id]))
            <div class="p-2 py-3 mb-2 bg-slate-100 hover:bg-slate-200 hover:text-slate-900 cursor-pointer text-slate-700" wire:click='builderObjectSelectedEvent("{{ $object->id }}")'>
                @if($object->getPlugin())
                    <div class="flex text-xs">
                        <div class="pr-2"><i class="fa fa-{{ $object->getPlugin()->getIcon() }}"></i></div>
                        <div>
                            <div>
                                <div>{{ $object->name }}</div>
                                <div>Plugin: {{ $object->getPlugin()->name }}</div>
                            </div>
                        </div>
                    </div>
                @else
                    Plugin '{{ $object->plugin_slug}}' nicht gefunden..
                @endif
            </div>
            @endif
        @endforeach
    </div>
</div>