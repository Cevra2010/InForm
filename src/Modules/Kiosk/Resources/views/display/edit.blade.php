@extends("layouts.backend.app")

@section("content")
    <h1 class="backend-headline flex items-center">
        @livewire("kiosk::display.online-state",['display' => $display]) <span class="ml-2">Bildschirm: {{ $display->name }} (<a href="{{ route("kiosk::present",$display->hash) }}" target="_blank">Bildschirm öffnen</a>)</span>
    </h1>
    <div class="flex mb-4">
        <a href="{{ route("kiosk::display.build",$display) }}">
            <div class="h-20 bg-slate-200 rounded items-center justify-center flex flex-col text-slate-600 px-2 hover:bg-slate-300 hover:cursor-pointer space-y-2">
                <i class="fa fa-tools"></i>
                <p class="text-sm">DisplayBuilder</p>
            </div>
        </a>
    </div>
    <h3 class="backend-headline-small">
        Bildschirmgröße ermitteln
    </h3>
    <div class="backend-panel">
        @livewire("kiosk::display.screen-size",['display' => $display])
    </div>
    <h3 class="backend-headline-small">
        öffentliche URL
    </h3>
    <div class="backend-panel">
        <form class="inform-form">
            <div class="form-group">
                <label for="url">URL:</label>
                <input type="text" name="url" value="{{ route("kiosk::present",$display->hash) }}" onclick="this.select();" />
            </div>
        </form>
    </div>
@endsection
