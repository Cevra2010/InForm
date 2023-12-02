@if($error)
    {{ $error }}
@else
<div class="@if($dataTable->hasWrapper()) inform-default-table-wrapper @endif">
    @livewire("inform-data-table::data-table",['table' => $dataTable->slug,'data' => $data])
</div>
@endif