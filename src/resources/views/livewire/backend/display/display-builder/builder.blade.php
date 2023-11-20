<div class="w-screen h-screen">

    <div class="flex bg-slate-200">
        <div id="toolbar" style="width: {{$toolbarWidth}}px" class="border-r border-slate-300 bg-slate-50 text-slate-600 text-xs">

            @if($moduleObjectEdit)
                <div class="bg-orange-300">
                    <div class="flex justify-between items-center w-full px-2 py-1 text-center">
                        <p>Modul-Einstellungen</p>
                        <div>
                            <button class="py-1 px-2 bg-orange-600 flex items-center justify-center rounded text-orange-900 " wire:click="closeModuleSettings">X</button>
                        </div>
                    </div>
                </div>
                <button wire:click='deleteObject' class="w-full bg-red-800 text-slate-50 p-1 text-xs">Ebene löschen <i class="fa fa-trash"></i></button>
                <!-- Z-Index controle //-->

                <div class="w-full p-1 text-center text-slate-50 bg-sky-700 shadow">
                    Ebenensteuerung
                </div>
                <div class="flex justify-between">
                    <button class="bg-sky-200 p-1 px-3 w-1/4" wire:click="zDown"><i class="fa fa-angle-down"></i></button>
                    <button class="bg-sky-200 p-1 px-3 w-1/4" wire:click="zDownest"><i class="fa fa-angles-down"></i></button>
                    <button class="bg-sky-200 p-1 px-3 w-1/4" wire:click="zUp"><i class="fa fa-angle-up"></i></button>
                    <button class="bg-sky-200 p-1 px-3 w-1/4" wire:click="zUppest"><i class="fa fa-angles-up"></i></button>
                </div>

                @livewire($moduleObjectEdit->getModule()->getBuilderComponent(),['object' => $moduleObjectEdit],key('module-object-edit-'.$moduleObjectEdit->id))
            @else
                <div class="w-full p-2 text-center bg-emerald-300 shadow">
                    Verfügbare Module (Drag item) <i class="fa fa-mouse"></i>
                </div>
                <div class="flex flex-col w-full space-y-2 p-2">
                @foreach($toolbarItems as $item)
                    <div class="w-full bg-slate-200 p-2 shadow border border-slate-300" draggable="true"
                         @dragstart="draggedModule = '{{ $item->name}}'; addModule = true"
                        >
                        {{ $item->name }}
                    </div>
                @endforeach
                </div>

                <div class="w-full p-2 text-center bg-sky-300 shadow">
                    Ebenen
                </div>
                <div class="flex flex-col w-full space-y-2 p-2">
                @foreach($displayObjects->sortBy("zindex") as $object)
                    <div class="w-full bg-slate-200 p-2 shadow border border-slate-300" draggable="true"
                         @dblclick="Livewire.dispatch('open-module-settings',{object:{{$object->id}}})"
                    >
                        {{ $object->getModule()->getName() }}
                    </div>
                @endforeach
                </div>
            @endif
        </div>
        <div class="flex w-full h-screen items-center justify-center flex-col overflow-scroll">

            <!-- SCREEN //-->
            <p class="text-slate-500 text-sm">Display: {{ $screenWidth }}px x {{ $screenHeight }}px | View: {{ $scratchWidth }}px x {{ $scratchHeight }}px | Offset: {{ $displayOffset }}px</p>
            <div id="screen" class="shadow-lg bg-white" style="width: {{ $scratchWidth }}px; height: {{ $scratchHeight }}px; overflow:auto; position: relative;" x-data
                 x-on:dragover.prevent
                 x-on:drop.prevent="dropModule(draggedModule,$event.pageX-$el.offsetLeft,$event.pageY-$el.offsetTop,addModule)"
            >

                @foreach($displayObjects as $object)
                    <div wire:key="object-{{ $object->id }}" id="obj-{{ $object->id }}" style="width: {{ ($object->width / $display->width) * $scratchWidth }}px; height: {{ round(($object->height / $display->height) * $scratchHeight) }}px; top: {{ ($object->pos_y / $display->height) * $scratchHeight }}px; left: {{ ($object->pos_x / $display->width) * $scratchWidth }}px; position: absolute; z-index:{{ $object->zindex }};"
                         class="@if($moduleObjectEdit && $moduleObjectEdit->id == $object->id) outline-1 outline-slate-400 outline-offset-4 outline-dashed border-slate-900 border-dotted @endif"
                        draggable="true"
                        @dragstart="spaceLeft = $event.pageX-$el.getBoundingClientRect().left; spaceTop = $event.pageY-$el.getBoundingClientRect().top;  draggedModule = '{{ $object->id}}'; addModule = false"
                        @dblclick="Livewire.dispatch('open-module-settings',{object:{{$object->id}}})"
                    >
                        @livewire($object->getModule()->getBuilderViewComponent(),['object' => $object],key('object-'.$object->id))
                    </div>
                @endforeach

                @foreach($displayObjects as $object)
                    @if($moduleObjectEdit && $object->id == $moduleObjectEdit->id)
                    <div
                        @mousedown="initResize({{ $object->id }})"
                        id="resizer-{{ $object->id }}" style="cursor: se-resize; top: {{ (($object->pos_y / $display->height) * $scratchHeight) + round(($object->height / $display->height) * $scratchHeight) }}px; left: {{ (($object->pos_x / $display->width) * $scratchWidth) + ($object->width / $display->width) * $scratchWidth }}px; position: absolute; z-index:{{ $object->zindex }};"
                        class="rounded px-1 bg-slate-300 text-slate-600 text-center"
                    >
                        <i class="fa fa-up-right-and-down-left-from-center" style="font-size: 1em;"></i>
                    </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>

    @if($loadingState)
    <div style="position: absolute; top:0; left:0; width: 100%; height: 100%;" class="bg-black bg-opacity-50">
        LADEN...
    </div>
    @endif


    <script>
        document.addEventListener('livewire:initialized', function () {
            Livewire.dispatch('init-builder',{width:window.innerWidth,height:window.innerHeight});
        })

        function dropModule(name,left,top,add = false) {
            if(add) {
                Livewire.dispatch('add-module',{name: name,left: left,top: top})
            }
            else {
                Livewire.dispatch('update-module-position',{object: name,left: (left-spaceLeft),top: (top-spaceTop)})
            }
        }

        let resizerId;
        let screen = document.getElementById('screen');

        function initResize(id) {
            resizerId = id;
            console.log("SET ELEMENT TO "+resizerId);
            window.addEventListener('mousemove', Resize, false);
            window.addEventListener('mouseup', stopResize, false);
        }
        function Resize(e) {
            resizeingElement = document.getElementById('obj-' + resizerId);
            resizer = document.getElementById('resizer-' + resizerId);
            resizeingElement.style.width = (e.clientX - screen.offsetLeft - resizeingElement.offsetLeft) + 'px';
            resizeingElement.style.height = (e.clientY - screen.offsetTop - resizeingElement.offsetTop) + 'px';
            resizer.style.top = parseInt(resizeingElement.style.top) + parseInt(resizeingElement.style.height) + 'px';
            resizer.style.left = parseInt(resizeingElement.style.left) + parseInt(resizeingElement.style.width) + 'px';

        }
        function stopResize(e) {
            window.removeEventListener('mousemove', Resize, false);
            window.removeEventListener('mouseup', stopResize, false);
           Livewire.dispatch('update-module-size',{object: resizerId,width: resizeingElement.style.width,height: resizeingElement.style.height})
        }
    </script>
</div>
