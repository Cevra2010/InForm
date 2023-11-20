<div class="flex">
    <div class="ml-2">
        <a 
            @if(isset($action['confirmation']))
                wire:click="openConfirmation('{{ $action['name'] }}',{{ $tableRow }})"
            @else
                href="{{ route($action['route'],$this->getActionParameters($tableRow,$action)) }}" 
            @endif
            @if(isset($action['css'])) 
                class="{{ $action['css']}} @if(isset($action['confirmation'])) cursor-pointer @endif" 
            @endif
            >
            @if(isset($action['icon']))
                <i class="fa fa-{{ $action['icon'] }}"></i> 
            @endif
            {{ $action['name'] }}
        </a>
    </div>
</div>