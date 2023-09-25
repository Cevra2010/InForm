<div class="p-4 bg-sidebar p-2 space-y-2 flex flex-col w-60">

    <div class="mb-2">
        <p class="text-white text-center text-3xl font-bold dancing mb-2">InForm</p>
    </div>

    <a href="#">
        <div class="bg-slate-50 flex items-center justify-center p-3 rounded flex-col px-6 text-slate-600 bg-opacity-70 hover:bg-opacity-100">
            <p><i class="fa fa-home"></i></p>
            <p class="text-sm">Dashboard</p>
        </div>
    </a>

    @hasAccess("user")
    <a wire:navigate href="{{ route("backend.user.list") }}">
        <div class="bg-slate-50 flex items-center justify-center p-1 rounded flex-col px-6 text-slate-600 bg-opacity-70 hover:bg-opacity-100">
            <p><i class="fa fa-user-cog"></i></p>
            <p class="text-sm block">Konten & Rechte</p>
        </div>
    </a>
    @endhasAccess

    @hasAccess("group")
    <a wire:navigate href="{{ route("backend.group.index") }}">
        <div class="bg-slate-50 flex items-center justify-center p-1 rounded flex-col px-6 text-slate-600 bg-opacity-70 hover:bg-opacity-100">
            <p><i class="fa fa-user-group"></i></p>
            <p class="text-sm block">Benutzergruppen</p>
        </div>
    </a>
    @endhasAccess

    @hasAccess("modules")
    <a wire:navigate href="{{ route("backend.modules.list") }}">
        <div class="bg-slate-50 flex items-center justify-center p-1 rounded flex-col px-6 text-slate-600 bg-opacity-70 hover:bg-opacity-100">
            <p><i class="fa fa-cubes"></i></p>
            <p class="text-sm block">Module</p>
        </div>
    </a>
    @endhasAccess

    @hasAccess("display")
    <a wire:navigate href="{{ route("backend.display.list") }}">
        <div class="bg-slate-50 flex items-center justify-center p-1 rounded flex-col px-6 text-slate-600 bg-opacity-70 hover:bg-opacity-100">
            <p><i class="fa fa-display"></i></p>
            <p class="text-sm block">Bildschirme</p>
        </div>
    </a>
    @endhasAccess
</div>
