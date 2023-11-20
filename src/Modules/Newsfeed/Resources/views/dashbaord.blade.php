@extends("layouts.backend.app")

@section("content")
    <x-inform-headline title="Newsfeed: {{ $newsfeed->name}}" icon="newspaper" />
    <a wire:navigate href="{{ route("newsfeed::article.create",$newsfeed) }}" class="bg-teal-600 hover:bg-teal-700 text-white text-sm p-2 rounded shadow">
        <i class="fa fa-newspaper"></i> Artikel erstellen
    </a>

    <div class="flex w-full mt-8">
        <div class="bg-white h-10 border-l border-b border-t text-slate-600 rounded-tl rounded-bl border-slate-200 flex  items-center justify-items-center pl-2">
            <i class="fa fa-magnifying-glass text-slate-600"></i>
        </div>
        <div class="w-full bg-white border-b border-t border-r border-slate-200 rounded-tr border-br pl-2 h-10">
            <input type="text" class="outline-none h-full w-full" placeholder="{{ __("form.search")}}..." />
        </div>
    </div>

    <div class="grid grid-flow-row auto-rows-max gap-4 mt-4">
        <div>
            <x-inform-panel headline="Warten auf veröffentlichung" icon="bars-progress">
  
            </x-inform-panel>
        </div>
        <div>
            <x-inform-panel headline="Entwürfe" icon="pen-ruler">
                <x-inform-data-table table="newsfeed::edit-table" />
            </x-inform-panel>
        </div>

        <div class="col-span-3">
            <x-inform-panel icon="users" headline="Veröffentlichte Artikel">
                @livewire("newsfeed::dashboard.article-list",['newsfeed' => $newsfeed])
            </x-inform-panel>
        </div>
      </div>
@endsection