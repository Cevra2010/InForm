@if($parentArea->hasChilds())
    @php $deep++ @endphp
    @foreach($parentArea->getChilds() as $childArea)
        <div class="flex p-2 pl-4 border border-slate-200 text-slate-700">
            <div>
                @livewire("backend.user.area-toggle",['area' => $childArea,'role' => $role])
            </div>
            <div style="padding-left: {{ 20*$deep }}px;" class=""></div>
            <div>{{ $childArea->name }}</div>
        </div>

        @include("backend.user.roles.area-child",['parentArea' => $childArea])
    @endforeach
@endif
