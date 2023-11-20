@extends("layouts.base.html")

@section("body")
<video preload="metadata" autoplay muted loop playsinline class="w-full h-full sticky top-0 left-0 right-0 bottom-0 -z-10 object-cover">
    <source src="{{ asset("mp4/backgroud-vid.mp4") }}" type="video/mp4">
</video>

<div class="absolute top-0 left-0 w-screen h-screen">
    <div class="w-full flex items-center bg-white h-20 fixed pl-4">
        <img src="{{ asset('svg/logo-bf.svg') }}" class="h-16">
        <div class="w-full flex pl-20 space-x-10">
            <div class="text-sky-900 text-xl" style="font-family: 'Ubuntu Mono derivative Powerline'"><i class="fa fa-home"></i> DASHBOARD</div>
            <div class="text-sky-900 text-xl" style="font-family: 'Ubuntu Mono derivative Powerline'"><i class="fa fa-newspaper"></i> NEUIGKEITEN</div>
            <div class="text-sky-900 text-xl" style="font-family: 'Ubuntu Mono derivative Powerline'"><i class="fa fa-tree"></i> STAMMBAUM</div>
        </div>
    </div>
    <div class="flex flex-col items-center justify-center w-screen h-screen">
        <img src="{{ asset('svg/logo-bf-white.svg') }}" class="w-3/4">
        <div class="text-white text-bold dancing" style="font-size:8em;">InForm</div>
    </div>
</div>

<div class="h-60 w-full bg-slate-50 pt-20">
    <div class="container mx-auto">
        <h1 style="font-family: 'Ubuntu Mono derivative Powerline'" class="text-4xl text-sky-900">Neue Feuer-und Rettungswache 3 eröffnet</h1>
        <p class="text-slate-700 text-xs"><i class="fa fa-calendar"></i> 24.05.2034, 18:06 Uhr</p>
        <p class="mt-4">
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. <br>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, <br>sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. <br>Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, <br>no sea takimata sanctus est Lorem ipsum dolor sit amet.

            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        </p>



        <h1 style="font-family: 'Ubuntu Mono derivative Powerline'" class="text-4xl text-sky-900 mt-20">Neue ELW-Generation kurz vor Indienstnahme</h1>
        <p class="text-slate-700 text-xs"><i class="fa fa-calendar"></i> 24.05.2034, 18:06 Uhr</p>
        <p class="mt-4">
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. <br>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, <br>sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. <br>Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, <br>no sea takimata sanctus est Lorem ipsum dolor sit amet.

            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        </p>
    </div>
</div>
@endsection
