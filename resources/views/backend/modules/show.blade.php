@extends("layouts.backend.app")

@section("content")
    <h1 class="backend-headline">
        <i class="fa fa-cubes"></i> Module
    </h1>

    <div class="backend-panel mt-3">
        <table class="backend-table">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Installationspfad</th>
            </tr>
            </thead>
            <tbody>
                @foreach($modules as $module)
                    <tr onclick="window.location.href='{{ route("backend.modules.show",$module->getName()) }}'">
                        <td>
                            @if($module->isDisabled())
                                <i class="fa fa-dot-circle text-red-600"></i>
                            @else
                                <i class="fa fa-dot-circle text-green-600"></i>
                            @endif
                        </td>
                        <td>{{ $module->getName() }}</td>
                        <td>{{ $module->getPath() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
