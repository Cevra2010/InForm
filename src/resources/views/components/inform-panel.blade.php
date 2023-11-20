@if($headline)
<div class="backend-panel-headline">
    <div class="backend-panel-headline-headline">
        @if($icon)
        <i class="fa fa-{{ $icon}}"></i>
        @endif
        {{ $headline }}
    
    </div>
    <div class="backend-panel-body">
    {{ $slot }}
    </div>
</div>
@else
<div class="backend-panel">
    {{ $slot }}
</div>
@endif