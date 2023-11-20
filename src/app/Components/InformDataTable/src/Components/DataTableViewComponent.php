<?php
namespace Components\InformDataTable\Components;

use Components\InformDataTable\DataTable;
use Illuminate\View\Component;

class DataTableViewComponent extends Component {

    public string|null $error = null;
    public string|null $livewireComponentName = null;

    public function __construct(
        public string $table,
    ) {}

    public function render() {

        if(!$dataTable = DataTable::getTable($this->table)) {
            $this->error = 'Die Tabelle '.$this->table.' konnte nicht gefunden werden';
        }

        return view("inform-data-table::view-component",['dataTable' => $dataTable]);
    }

}