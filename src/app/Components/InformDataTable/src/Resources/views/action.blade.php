<div class="flex">
    <div class="ml-2 cursor-pointer">
        <form id="action_form_{{ $action['action_id'] }}" method="POST" action="{{ route($action['route'],$this->getActionParameters($tableRow,$action)) }}">
            @csrf
        </form>
        <a 
            @if(isset($action['confirmation']))
                wire:click="openConfirmation('{{ $action['action_id'] }}',{{ $tableRow }})"
            @else
                @if($action['post'])
                onclick="document.getElementById('action_form_{{ $action['action_id'] }}').submit();"
                @else
                href="{{ route($action['route'],$this->getActionParameters($tableRow,$action)) }}" 
                @endif
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