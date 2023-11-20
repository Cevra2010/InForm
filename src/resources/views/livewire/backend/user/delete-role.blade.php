<div class="text-slate-700 text-sm p-4">


    @include("layouts.backend.error_success")
    @if($usersInRole->count())
        <p>
            Aktuell ist noch <b>{{ $usersInRole->count() }}</b> Benutzerkonten dieser Benutzerrolle zugeordnet.
        </p>

        @if($usersInRoleOnly->count())
            <p>
                Von {{ $usersInRole->count() }} Benutzerkonten befinden sich <b>{{ $usersInRoleOnly->count() }}</b> Konten in keiner anderen Rolle.
            </p>
        @endif

        <p class="mt-2 font-semibold">
            Benutzer in eine andere Benutzerrolle verschieben
        </p>
            <form class="inform-form" wire:submit.prevent="submit">
                <div class="form-group">
                    <label for="newGroup">Verschieben nach:</label>
                    <select wire:model.live="newGroup" id="newGroup">
                        @foreach($roles as $newUserRole)
                            @if($newUserRole->id != $role->id)
                                <option value="{{ $newUserRole->id }}" @if($newGroup == $newUserRole->id) selected @endif >{{ $newUserRole->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <button type="submit">Benutzer jetzt in neue Benutzerrolle verschieben</button>
            </form>
    @else
        <p class="text-slate-500 mb-4">
            Um ein versehentliches Löschen zu vermeiden, geben Sie bitte vor dem Löschen den untenstehenden Sicherheitsschlüssel ein.
        </p>
        <div class="w-full bg-slate-200 text-slate-500 text-lg font-semibold p-2 rounded mb-4">
            {{ $deleteKey }}
        </div>
        <form class="inform-form" wire:submit.prevent="submitDelete">
            <div class="form-group">
                <label for="newGroup">Sicherheitsabfrage</label>
                <input type="text" wire:model.live="givenKey" value="">
            </div>

            <button type="submit">Benutzerrolle löschen</button>
        </form>
    @endif
</div>
