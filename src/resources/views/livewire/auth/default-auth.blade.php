<div>
    <form wire:submit="submit">
        @csrf
        <div class="flex flex-col">
            @error("invalid")
                <p class="text-red-700 py-2 text-sm">{{$message}}</p>
            @enderror
            <div class="flex rounded border @error("username") border-red-300 @enderror mb-2">
                <div class="h-8 w-8 flex items-center justify-center text-slate-500 p-6"><i class="fa fa-user"></i></div>
                <label>
                    <input type="text" wire:model="username" class="w-full bg-slate-50 rounded-r h-8 outline-none text-slate-700 py-6" placeholder="Benutzername">
                </label>
            </div>
            <div class="flex rounded border mb-2 @error("password") border-red-300 @enderror">
                <div class="h-8 w-8 flex items-center justify-center text-slate-500 p-6"><i class="fa fa-key"></i></div>
                <label>
                    <input type="password" wire:model="password" class="w-full bg-slate-50 rounded-r h-8 outline-none text-slate-700 py-6" placeholder="Passwort">
                </label>
            </div>

            <button type="submit" class="p-2 bg-gradient-to-r from-sky-600 via-indigo-500 to-indigo-900 rounded text-white hover:ring-2 ring-offset-2 ring-indigo-600">Anmelden</button>
        </div>
    </form>
</div>
