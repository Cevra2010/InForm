@if($confirmation)
<div class="absolute top-0 left-0 w-screen h-screen bg-black bg-opacity-30 flex items-center justify-center">
    <div class="bg-slate-50 p-8 px-16 rounded">
        <p class="font-bold">Bestätigung erforderlich</p>
        <hr>
        <p class="py-4">
        {{ $confirmationText }}
        </p>
        <div class="flex space-x-2">
            <button type="button" wire:click="disconfirmAction" class="bg-red-500 rounded px-2 py-1 text-white">Abbrechen</button>
            <button type="button" wire:click='confirmAction' class="bg-teal-500 rounded px-2 py-1 text-white">Aktion Bestätigen</button>
        </div>
    </div>
</div>
@endif