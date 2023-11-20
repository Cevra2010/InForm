<div>

    <!-- Loading //-->
    @if($loading)
    <div style="position: absolute; top:0; left:0; width: 100%; height: 100%; z-index:8000" class="bg-black bg-opacity-50">
        <div class="flex w-full h-full items-center justify-center">
            <div class="text-white">
                <div class="text-center text-2xl font-bold">InForm</div>
                <i class="fa fa-spinner animate-spin mr-2"></i> Kiosk Builder wird geladen...
            </div>
        </div>
    </div>
    @endif

    @if($addPlugin)
    <div style="position: absolute; top:0; left:0; width: 100%; height: 100%; z-index:8000" class="bg-black bg-opacity-50" wire:click='$toggle("addPlugin")'>
        <div class="flex h-full items-center justify-center">
            <div class="bg-white p-4 border w-1/2">
                <p class="text-2xl font-bold mb-2">Plugin hinzufügen</p>
                <hr>

                <div class="w-full h-full overflow-auto text-sm">
                @foreach(Modules\Kiosk\KioskPluginManager\KioskPluginManager::getPlugins() as $plugin)
                    <div class="@if(!$loop->last) border-b @endif p-2 w-full flex items-center bg-slate-100 hover:bg-teal-200 cursor-pointer" wire:click='addPluginBySlug("{{ $plugin->getSlug() }}")'>
                        <i class="fa fa-{{$plugin->getIcon() }}"></i> <span class="ml-2">{{ $plugin->getName() }}</span>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif


    <!-- Header Buttons //-->
    <div class="top-2 absolute w-full text-center" style="heigt: 80px;">
        <div class="flex w-full items-center justify-center space-x-8" x-data="{ addPluginMenu: false }">
            <div>
                <div class="hover:bg-teal-400 @if($grid) bg-slate-500 text-white @endif cursor-pointer flex justify-center items-center rounded-full h-12 w-12" wire:click='$toggle("grid")'><i class="fa fa-table-cells"></i></div>
                <p class="text-xs">Grid</p>
            </div>
            <div>
                <div class="hover:bg-teal-400 cursor-pointer flex justify-center items-center rounded-full h-12 w-12" wire:click='zoomIn'><i class="fa fa-magnifying-glass-plus"></i></div>
                <p class="text-xs">Zoom-In</p>
            </div>
            <div>
                <div class="hover:bg-teal-400 cursor-pointer flex justify-center items-center rounded-full h-12 w-12" wire:click='resetZoom'>{{ $zoomFactor }}</div>
                <p class="text-xs">%</p>
            </div>
            <div>
                <div class="hover:bg-teal-400 cursor-pointer flex justify-center items-center rounded-full h-12 w-12" wire:click='zoomOut'><i class="fa fa-magnifying-glass-minus"></i></div>
                <p class="text-xs">Zoom-Out</p>
            </div>
            <div>
                <div class="hover:bg-teal-400 cursor-pointer flex justify-center items-center rounded-full h-12 w-12" wire:click='$toggle("addPlugin")'><i class="fa fa-plus"></i></div>
                <p class="text-xs">Neues Plugin</p>
            </div>
        </div>
    </div>
 
    <!-- Layout //-->
    <div class="fw-screen h-screen px-4 pb-4">
        <div class="flex w-full h-full" style="padding-top:80px;">
            <div class="px-2">

                <!-- Sidebar //-->

                @livewire("kiosk::builder.sidebar",['display' => $display])

            </div>
            <div class="overflow-scroll relative">



                <!-- Scratchboard //-->
                <div 
                class="rounded bg-white" 
                id="scratchboard" 
                style="width: {{ $display->width / 100 * $zoomFactor}}px; height: {{ $display->height / 100 * $zoomFactor}}px; position: relative; overflow:hidden;"
                x-data
                @mousemove="moveObject"
                >

                    <!-- Raster //-->
                    @if($grid)
                        @for($i = (50 / 100 * $zoomFactor); $i < ($display->width / 100 * $zoomFactor); $i = $i + (50 / 100 * $zoomFactor))
                            <div style="width: 1px; height: 100%; left: {{ $i }}px; position: absolute; z-index: 1000;" class="bg-slate-900 opacity-10"></div>
                        @endfor

                        @for($i =  (50 / 100 * $zoomFactor); $i < ($display->height / 100 * $zoomFactor); $i = $i + (50 / 100 * $zoomFactor))
                        <div style="height: 1px; width: 100%; top: {{ $i }}px; position: absolute; z-index: 1000;" class="bg-slate-900 opacity-10"></div>
                        @endfor
                    @endif


                    <!-- Display Objects //-->
                    @foreach($displayObjects as $object)          
                    <div wire:key="object-{{ $object->id }}" 
                        id="{{ $object->id }}" 
                        style="width: {{ ($object->width / 100) * $zoomFactor }}px; height: {{ round(($object->height / 100) * $zoomFactor) }}px; top: {{ ($object->pos_y / 100) * $zoomFactor }}px; left: {{ ($object->pos_x / 100) * $zoomFactor }}px; position: absolute; z-index:{{ $object->zindex }};"
                        class="container" 
                        @mousedown="startMove($el)"
                        @dblclick="selectMoveObject($el)"
                        >
                        @if($object->getPlugin()) 
                            @livewire($object->getPlugin($object->plugin_slug)->getBuilderViewComponent(),['object' => $object,'zoomFactor' => $zoomFactor],key('object-'.$object->id))
                        @else
                            Plugin '{{ $object->plugin_slug}}' nicht gefunden.
                        @endif
                    </div>
                    @endforeach


                    <div 
                        class="hidden bg-teal-600 cursor-nw-resize text-white text-xs rounded-full" 
                        style=" width:15px; height:15px; z-index:500; position: absolute; top:o; left:0;" 
                        id="resizer"
                        @mousedown="resizeObject($el)"
                        >
                        <div class="flex items-center">

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div id="object-toolbar" style="top:0; left:0;" class="absolute hidden">
            Toolbar
        </div>
    </div>     
      <script> 
        let scratchboard = document.querySelector("#scratchboard")
        let mousedown = false
        let clientX
        let clientY
        let boxX
        let boxY
        let movingObject = null
        let isResizing = false
        let lastObjectId = null;
        let resizer = document.querySelector("#resizer")

        function selectMoveObject(el) {
            movingObject = el
            document.querySelector("body").classList.add("prevent-select");
            positionResizer();
            resizer.classList.remove("hidden")
            el.classList.add("outline-dashed")
            el.classList.add("outline-1")
            el.classList.add("outline-slate-700")
            if(lastObjectId != movingObject.id) {
                if(lastObjectId != null) {
                    lastObject = document.getElementById(lastObjectId);
                    lastObject.classList.remove("outline-dashed")
                    lastObject.classList.remove("outline-1")
                    lastObject.classList.remove("outline-slate-700")
                }
                lastObjectId = movingObject.id
            }
            Livewire.dispatch('builder-object-selected',{object_id:movingObject.id})
        }

        function positionResizer() {
            resizer.style.left = movingObject.offsetLeft + movingObject.offsetWidth - 10 +'px';
            resizer.style.top = movingObject.offsetTop + movingObject.offsetHeight - 10 +'px';
        }

        function startMove(el) {
            if(movingObject != null) {
                movingObject.style.cursor = 'move'
                boxX = event.clientX - movingObject.getBoundingClientRect().left
                boxY = event.clientY - movingObject.getBoundingClientRect().top
                mousedown = true
            }
        }

        function unselectMoveObject() {
            movingObject.style.cursor = 'default';
            movingObject = null
            resizer.classList.add("hidden");
            document.querySelector("body").classList.remove("prevent-select");
        }

        function moveObject(el) {
            clientX = el.clientX
            clientY = el.clientY

            /** resizing Object **/
            if(isResizing && moveObject != null) {
                newWidth = clientX - movingObject.offsetLeft - scratchboard.getBoundingClientRect().left
                newHeight = clientY - movingObject.offsetTop - scratchboard.getBoundingClientRect().top

                movingObject.style.width = newWidth+'px'
                movingObject.style.height = newHeight+'px'
                positionResizer();
            }

            /** moving object **/
            if(mousedown && moveObject != null) {
                newX = clientX - scratchboard.getBoundingClientRect().left - boxX
                newY = clientY - scratchboard.getBoundingClientRect().top - boxY

                if(newX > 0 && (newX + movingObject.offsetWidth) < scratchboard.offsetWidth) {
                    movingObject.style.left = newX + 'px'; 
                }

                if(newY > 0 && (newY + movingObject.offsetHeight) < scratchboard.offsetHeight) {
                    movingObject.style.top = newY + 'px'; 
                }

                positionResizer();
            }
        }

        function resizeObject(el) {
            isResizing = true
        }

        window.addEventListener("mouseup",function() {
            if(mousedown) {
                mousedown = false
                movingObject.style.cursor = 'auto'
                Livewire.dispatch('display-object-moved',{
                    object_id: movingObject.id,
                    x: parseFloat(movingObject.style.left),
                    y: parseFloat(movingObject.style.top),
                })
            }
            if(isResizing) {
                isResizing = false
                Livewire.dispatch('display-object-resized',{
                    object_id: movingObject.id,
                    width: parseFloat(movingObject.style.width),
                    height: parseFloat(movingObject.style.height),
                })
            }
        })

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('selected-to-null',function() {
                unselectMoveObject()
            })
         })

        
      </script> 
     
     <style>
        .prevent-select {
            -webkit-user-select: none; /* Safari */
            -ms-user-select: none; /* IE 10 and IE 11 */
            user-select: none; /* Standard syntax */
        }
    </style>
            
</div>