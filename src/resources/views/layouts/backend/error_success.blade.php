@if($errors->count())
    <div class="border border-red-200 bg-red-100 rounded p-2 m-2 text-red-800 text-sm">
        <p>Bitte überprüfen Sie ihre Eingabe/n:</p>
        <ul class="list-disc">
        @foreach($errors->all() as $error)
            <li class="ml-4">{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

@if(session()->has("success"))
    <div class="border border-green-200 bg-green-100 rounded p-2 m-2 text-green-800 text-sm">
        @if(session()->get("success") === true)
            {{ __("form.success")}}
        @else
            {{ session()->get("success") }}
        @endif
    </div>
@endif
