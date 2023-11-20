<div>
    <div class="flex items-center space-x-5 text-slate-700 my-4">
        <i class="fa fa-info-circle text-2xl"></i>
        <p>
            {!! __("backend.user.userroles_infotext") !!}
        </p>
    </div>
    @foreach($roles as $role)
        <div class="flex items-center mb-2 space-x-3 bg-slate-100 hover:bg-slate-200 p-2 cursor-pointer" wire:click='changeRole("{{ $role->id }}")'>
            @if($user->roles()->find($role))
                <div class="p-4 bg-gradient-to-tr from-green-700 to-teal-500 text-white text-2xl px-6 rounded shadow">
                    <i class="fa fa-circle-check"></i>
                </div>
            @else
                <div class="p-4 bg-gradient-to-tr from-red-700 to-orange-500 text-white text-2xl px-6 rounded shadow">
                    <i class="fa fa-circle-xmark"></i>
                </div>
            @endif
            <div>
                {{ $role->name }}
                @if($user->roles()->find($role))
                    <p class="text-green-600">{{ __("backend.user.role") }}: {{ __("backend.user.active") }}</p>
                @else
                    <p class="text-red-600">{{ __("backend.user.role") }}: {{ __("backend.user.inactive") }}</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
