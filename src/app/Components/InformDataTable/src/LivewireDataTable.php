<?php
namespace Components\InformDataTable;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Kiosk\Entities\Display;
use ReflectionClass;

class LivewireDataTable extends Component {

    use WithPagination;

    public $columns;
    public $css_TableClass;
    public $headerUpperCase;
    public $confirmation = false;
    public $confirmationText = null;
    public $confirmationRow = null;
    public $confirmationAction = null;
    public $pagination;
    public $search;
    public $searchQuery;
    public $sorts;

    protected $table;
    public $tableName;

    public function mount($table) {
        $this->tableName = $table;
        $this->table = DataTable::getTable($table);
        $this->columns = $this->table->getColumns();
        $this->css_TableClass = $this->table->getCssTableClass();
        $this->headerUpperCase = $this->table->isHeaderUpperCase();
        $this->pagination = $this->table->hasPagination();
        $this->search = $this->table->hasSearch();
        $this->sorts = [];
    }

    public function getColumns() {
        return $this->table->getColumns();
    }

    public function getColumnValue($key,$value,$row = null) {

        if(strpos($key,'->')) {
            $explodition = explode('->',$key);
            $value = $row->{$explodition[0]}[$explodition[1]];
        }

        if($this->table->keyIsDatetime($key)) {
            return $this->table->getFormatedDateTime($key,$value);
        }

        if($this->table->keyIsCount($key)) {
            return $this->table->getCountContent($key,$value);
        }

        if($this->table->keyIsCallback($key)) {
            $function = $this->table->getCallback($key);
            return $function($row);
        }
        return $value;
    }

    public function isSortable($key) {
        return $this->table->isKeySortable($key);
    }

    public function hasActions() : bool {
        return $this->table->hasActions();
    }

    public function getActions() : array {
        return $this->table->getActions();
    }

    public function isRowLinked() {
        return $this->table->isRowLinked();
    }

    public function getRowLinkRoute() {
        return $this->table->getRowLinkRoute();
    }

    public function getRowLinkParameters($rowObject) {
        return $this->table->getRowLinkParameters($rowObject);
    }

    public function getActionParameters($rowObject,$action) {
        return $this->table->getActionParameters($rowObject,$action);
    }

    public function confirmAction() {
        $table = DataTable::getTable($this->tableName);
        $confirmation = $table->getConfirmation($this->confirmationAction);
        $confirmation['callback']($this->confirmationRow);
        $this->confirmation = false;
        $this->confirmationText = null;
        $this->confirmationRow = null;
        $this->confirmationAction = null;
    }

    public function disconfirmAction() {
        $this->confirmation = false;
        $this->confirmationText = null;
        $this->confirmationRow = null;
        $this->confirmationAction = null;
    }

    public function render() {
        $this->table = DataTable::getTable($this->tableName);
        foreach($this->sorts as $key => $value) {
            $this->table->setSort($key,$value['direction']);
        }
        $data = $this->table->searchFor($this->searchQuery)->getResult();

        return view("inform-data-table::table",[
            'data' => $data,
        ]);
    }

    public function openConfirmation($confirmationAction,$tableRow) {
        $table = DataTable::getTable($this->tableName);
        $confirmation = $table->getConfirmation($confirmationAction);
        $this->confirmationRow = $tableRow;
        $this->confirmation = true;
        $this->confirmationText = $confirmation['text'];
        $this->confirmationAction = $confirmationAction;
    }

    public function getSortIcon($key) {
        if(array_key_exists($key,$this->sorts)) {
            if($this->sorts[$key]['direction'] == "ASC") {
                return 'arrow-down-short-wide';
            }
            else {
                return 'arrow-up-wide-short';
            }
        }
        return 'sort';
    }

    public function sort($key) {
        if(array_key_exists($key,$this->sorts)) {
            if($this->sorts[$key]['direction'] == "ASC") {
                $this->sorts[$key] = ['direction' => 'DESC'];
            }
            else {
                unset($this->sorts[$key]);
            }
        }
        else {
            $this->sorts[$key] = ['direction' => 'ASC'];
        }
    }

    public function columnHasAccess($key) {
        return $this->table->columnHasAccess($key);
    }

    public function actionHasAccess($key) {
        return $this->table->actionHasAccess($key);
    }

}