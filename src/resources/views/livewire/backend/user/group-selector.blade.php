<div>
    @if(!$groups)
        Es sind keine Benutzergruppen angelegt.
    @else
        @foreach($groups as $group)
        <div class="flex items-center mb-2 space-x-3 bg-slate-100 hover:bg-slate-200 p-2 cursor-pointer" wire:click='changeGroup("{{ $group->id }}")'>
            @if($user->groups()->find($group))
                <div class="p-4 bg-gradient-to-tr from-green-700 to-teal-500 text-white text-2xl px-6 rounded shadow">
                    <i class="fa fa-circle-check"></i>
                </div>
            @else
                <div class="p-4 bg-gradient-to-tr from-red-700 to-orange-500 text-white text-2xl px-6 rounded shadow">
                    <i class="fa fa-circle-xmark"></i>
                </div>
            @endif
            <div>
                {!! $group->getBadge() !!}
                @if($user->groups()->find($group))
                    <p class="text-green-600">{{ __("backend.user.usergroup") }}: {{ __("backend.user.active") }}</p>
                @else
                    <p class="text-red-600">{{ __("backend.user.usergroup") }}: {{ __("backend.user.inactive") }}</p>
                @endif
            </div>
        </div>
        @endforeach
    @endif
</div>
