<div style="width: 100%;
    height: 100%;
    {{ $this->getColorStyle("container-bg","background-color: {hex};") }}
    @if($this->displayObject->data['border']) {{ $this->getColorStyle('container-border',"border: ".$this->displayObject->data['border']."px solid {hex}") }}; @endif"
     class="
    {{ $this->getColorClass("container-bg") }}
    {{ $this->getColorClass("container-border","border-".$this->displayObject->data['border']." border") }}
     @if($displayObject->data['shadow'] != 0) shadow-{{ $this->displayObject->data['shadow'] }} @endif
      @if($displayObject->data['rounded'] != 0) rounded-{{ $this->displayObject->data['rounded'] }} @endif
     ">
</div>
