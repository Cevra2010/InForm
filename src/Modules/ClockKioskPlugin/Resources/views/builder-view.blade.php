<div>
    <p style="color: {{ $data->font_color }}; font-family: '{{ $data->font_family}}'; font-size: {{ $this->calcSize($data->font_size) }}px;" id="inform-time-{{$displayObjectId}}">
        <i class="fa fa-spinner animate-spin"></i>
    </p>
    <script>
        var informTimer{{$displayObjectId}};

        function updateClock() {
            time = new Date();
            informTimeElement = document.getElementById('inform-time-{{$displayObjectId}}');
            informTimeElement.innerHTML = time.getHours()+":"+time.getMinutes();
        }

        informTimer{{$displayObjectId}} = setInterval(updateClock, 1000);
    </script>
</div>