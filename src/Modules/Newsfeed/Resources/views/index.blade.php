@extends("layouts.backend.app")

@section("content")
    <x-inform-headline title="Newsfeed" icon="newspaper" />
    <a wire:navigate href="{{ route("newsfeed::add-newsfeed") }}" class="bg-teal-600 hover:bg-teal-700 text-white text-sm p-2 rounded shadow">
        <i class="fa fa-newspaper"></i> Newsfeed erstellen
    </a>
    <x-inform-panel>
        <table class="backend-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Leserechte</th>
                    <th>Schreibrechte</th>
                    <th>Veröffentlichen</th>
                    <th>{{ __("form.created-at") }}</th>
                    <th>{{ __("form.updated-at") }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($newsfeeds as $feed)
                    <tr onclick="window.location.href='{{ route("newsfeed::show",$feed) }}'">
                        <td class="font-bold align-top">{{ $feed->name }}</td>
                        <td class="align-top">
                            @if($feed->groupsRead->count())
                            <div class="flex flex-col space-y-1">
                                @foreach($feed->groupsRead as $group)
                                    {!! $group->getBadge() !!}
                                @endforeach
                            </div>
                            @else
                                <span class="rounded px-2 py-1 text-xs bg-slate-700 text-white">Alle Benutzergruppen</span>
                            @endif
                        </td>
                        <td class="align-top">
                            @if($feed->groupsWrite->count())
                                <div class="flex flex-col space-y-1">
                                    @foreach($feed->groupsWrite as $group)
                                        {!! $group->getBadge() !!}
                                    @endforeach
                                </div>
                            @else
                            <span class="rounded px-2 py-1 text-xs bg-slate-700 text-white">Keine Benutzergruppen</span>
                            @endif
                        </td>
                        <td class="align-top">
                            @if($feed->groupsPublish->count())
                                <div class="flex flex-col space-y-1">
                                    @foreach($feed->groupsPublish as $group)
                                        {!! $group->getBadge() !!}
                                    @endforeach
                                </div>
                            @else
                            <span class="rounded px-2 py-1 text-xs bg-slate-700 text-white">Keine Benutzergruppen</span>
                            @endif
                        </td>
                        <td class="align-top">{{ $feed->created_at->format("d.m.Y") }}</td>
                        <td class="align-top">{{ $feed->updated_at->format("d.m.Y") }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-inform-panel>
@endsection