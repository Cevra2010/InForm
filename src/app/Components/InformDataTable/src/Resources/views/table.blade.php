<div>
    <!-- DEV //-->
    <div class="inform-default-table"></div>

    @include("inform-data-table::confirmation")

    @if($pagination)
        {{ $data->links("inform-data-table::pagination") }}
    @endif

    @if($search)
        @include("inform-data-table::search")
    @endif

    <table class="{{ $css_TableClass }}">
        <thead>
            <tr>
                @foreach($this->getColumns() as $column) 
                    @if($this->columnHasAccess($column['key']))
                        <th class="{{ ($headerUpperCase ? "uppercase" : "") }}">
                            @if($this->isSortable($column['key']))
                            <i class="fa fa-{{ $this->getSortIcon($column['key']) }} cursor-pointer" wire:click='sort("{{ $column['key'] }}")'></i>
                            @endif
                            @if(isset($column['icon']))
                            <i class="fa fa-{{ $column['icon'] }}"></i>
                            @endif
                            {{ $column['name'] }}
                        </th>
                    @endif
                @endforeach
                @if($this->hasActions())
                    <th class="{{ ($headerUpperCase ? "uppercase" : "") }}">
                        Aktionen
                    </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($tableData as $tableRow) 
                <tr @if($this->isRowLinked()) class="inform-default-table-row-linked" @endif>
                    @foreach($this->getColumns() as $column) 
                    <td @if($this->isRowLinked()) onclick="window.location.href='{{ route($this->getRowLinkRoute(),$this->getRowLinkParameters($tableRow)) }}'" @endif>                                 
                       {!! $this->getColumnValue($column['key'],$tableRow->{$column['key']},$tableRow) !!}
                    </td>
                    @endforeach
                    @if($this->hasActions())
                        <td>
                            <div class="w-full flex space-x-1">
                    @endif
                    @foreach($this->getActions() as $action)
                        @if($this->actionHasAccess($action['name']))
                            @include("inform-data-table::action")
                        @endif
                    @endforeach
                    @if($this->hasActions())
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>