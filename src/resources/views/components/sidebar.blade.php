<div class="bg-sidebar space-y-2 flex flex-col w-80">
    <div class="mt-4 border-slate-600">
        <p class="text-white text-center text-3xl font-bold dancing">InForm</p>
        <p class="text-white text-center text-xs mb-2">be <b>Inform</b>ed...</p>
    </div>
    <div class="border-slate-600 flex  items-center justifly-center p-4 bg-slate-600 space-x-3 shadow-xl">
        <img src="{{ asset("images/avatars/avatar.jpg")}}" class="shadow object-fit w-14 h-14 border-2 rounded-full">
        <div>
        <p class="text-white my-2 text-xs ">Herzlich Willkommen</p>
        <p class="text-white my-2 text-xs font-bold">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
        </div>
    </div>

    <div class="py-2 px-4">
        @foreach($sidebar as $sidebarObject)
            @if(!$sidebarObject->hasAccess())
                @continue
            @endif
            @if($sidebarObject->isHeadline())
                <div class="uppercase p-2 text-slate-50 mt-2 text-xs font-bold">
                    {{ $sidebarObject->name }}
                </div>
            @else

                @if($sidebarObject->hasChilds())
                <div x-data="">
                @endif
                        @if(!$sidebarObject->hasChilds())
                        <a href="{{ $sidebarObject->getRoute() }}">
                        @endif
                        <div class="mb-1 p-2 text-slate-50 text-sm flex items-center rounded @if($sidebarObject->isActive()) bg-teal-700 cursor-default @else hover:bg-slate-600 cursor-pointer  @endif" @if($sidebarObject->hasChilds()) x-on:click="$store.{{ $sidebarObject->getUniqeId() }}.toggle()" @endif :class="$store.{{ $sidebarObject->getUniqeId() }}.on && 'bg-slate-600'">
                            <div class="w-5 text-xs">
                                @if($sidebarObject->icon)
                                    <i class="fa fa-{{ $sidebarObject->icon }}"></i>
                                @else
                                    <i class="fa-regular fa-circle"></i>
                                @endif
                            </div>
                            <div>{{ $sidebarObject->name }}</div>
                            @if($sidebarObject->hasChilds())
                            <div class="ml-auto">
                                <div x-show="!$store.{{ $sidebarObject->getUniqeId() }}.on"><i class="fa fa-angles-down"></i></div>
                                <div x-show="$store.{{ $sidebarObject->getUniqeId() }}.on"><i class="fa fa-angles-up"></i></div>
                            </div>
                            @endif

                        </div>
                        @if(!$sidebarObject->hasChilds())
                        </a>
                        @endif

                @if($sidebarObject->hasChilds())
                    <div x-show="$store.{{ $sidebarObject->getUniqeId() }}.on" x-transition class="my-1">
                        @foreach($sidebarObject->childs as $child)
                        @if(!$child->hasAccess())
                            @continue
                        @endif
                        
                        <a href="{{ $child->getRoute() }}">
                        <div class="ml-2 mb-1 p-2 text-slate-50 text-sm flex items-center rounded @if($child->isActive()) bg-teal-700 cursor-default @else hover:bg-slate-600 cursor-pointer  @endif">
                            <div class="w-5 text-xs ml-3">
                                @if($child->icon)
                                    <i class="fa fa-{{ $child->icon }}"></i>
                                @else
                                    <i class="fa-regular fa-circle"></i>
                                @endif
                            </div>
                            <div>{{ $child->name }}</div>
                        </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            @endif
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        @foreach($sidebar as $sidebarObject)
        Alpine.store('{{ $sidebarObject->getUniqeId() }}', {
            on: Alpine.$persist(false).as('{{ $sidebarObject->getUniqeId() }}'),
            toggle() {
                this.on = ! this.on
            }
        })
        @endforeach
    })
</script>