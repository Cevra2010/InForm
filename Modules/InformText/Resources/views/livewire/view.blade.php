<div>
    <p style="
    {{ $this->getColorStyle("text-color","color: {hex};") }}
    font-size: {{$displayObject->data['font-size']}}em;
    @if($displayObject->data['bold']) font-weight:bold; @endif
    font-family: {{ $displayObject->data['font-family'] }};

    "
       class="{{ $this->getColorClass("text-color","text") }}"
    >
        @if($displayObject->data['cursiv'] == "true") <i> @endif
        @if($displayObject->data['bold'] == "true") <b> @endif
        {{ $displayObject->data['text'] }}
        @if($displayObject->data['bold'] == "true") </b> @endif
        @if($displayObject->data['cursiv'] == "true") </i> @endif
    </p>
</div>
