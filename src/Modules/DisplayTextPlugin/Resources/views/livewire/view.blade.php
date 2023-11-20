<div class="h-full w-full">
    @if($data->bold)
    <style>
        #object-{{ $displayObjectId }} {
            font-weight: bold;
        }
    </style>
    @endif
    @if($data->cursive)
    <style>
        #object-{{ $displayObjectId }} {
            font-style: italic;
        }
    </style>
    @endif
    @if($data->underline)
    <style>
        #object-{{ $displayObjectId }} {
            text-decoration: underline;
        }
    </style>
    @endif
    <textarea wire:model.live.debounce.250ms='data.text' id="object-{{ $displayObjectId }}" style="color: {{ $data->font_color }}; font-size: {{ $data->font_size }}px; font-family: '{{ $data->font_family }}', cursiv; width:100%; height:100%; background:transparent;" class="resize-none border-0 focus:ring-0 focus:ring-offset-0 focus:outline-none focus:border-0"></textarea>
    <script>
        textarea = document.getElementById('object-{{ $displayObjectId }}');
        textarea.contentEditable = true;
    </script>
</div>