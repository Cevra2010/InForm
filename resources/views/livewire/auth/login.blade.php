<div>
    @if($authMethod)
        <div class="py-1 text-center bg-gradient-to-br from-sky-600 via-indigo-700 to-indigo-900 rounded text-white text-sm hover:ring ring-offset-2 shadow">
        <a href="#resetAuthMethod" wire:click="resetSelectedAuthMethod">Andere Methode wählen</a>
        </div>
        <div class="mt-4">
            @include($authMethodView)
        </div>
    @else
        <p class="pb-2 text-slate-700">Bitte wählen Sie Ihre Anmeldeoption</p>
        <hr>
        <ul class="cursor-pointer text-slate-500">
        @foreach($methods as $method)
            <a href="#select" wire:click="selectAuthOption('{{ $method->getName() }}')">
            <li class="py-4 border-b hover:bg-slate-100 px-2 hover:text-blue-500">
                <i class="fa fa-arrow-circle-right"></i> {{ $method->getName() }}
            </li>
            </a>
        @endforeach
        </ul>
    @endif
</div>
