<div class="flex space-x-1">
    <div wire:click='setAll' class="inform-group-badge @if($selectedGroups->count()) bg-slate-200 text-slate-800 cursor-pointer @else bg-teal-700 text-white @endif">{{ $firstActionName}}</div>
    @foreach($groups as $group)
        <div class="inform-group-badge cursor-pointer @if($selectedGroups->where('id',$group->id)->count()) {{ $group->getBadgeTextColorAsCssClass()}}" style="background-color: {{ $group->color }};" @else " @endif wire:click='toggleGroup({{ $group->id }})'><i class="fa fa-{{ $group->icon }}"></i> {{ $group->name }}</div>
    @endforeach
    <input type="hidden" name="{{ $target }}" value="{{ $selectedGroups->toJson() }}">
</div>
