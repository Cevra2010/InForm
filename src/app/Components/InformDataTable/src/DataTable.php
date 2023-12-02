<?php
namespace Components\InformDataTable;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Livewire;
use Illuminate\Support\Str;

/**
 * DataTable
 */
class DataTable {

    CONST DEFAULT_DATE_TIME_FORMAT = 'd.m.Y, H:i';
    CONST DEFAULT_CSS_TABLE_CLASS = 'inform-default-table';
    CONST DEFAULT_CONFIRMATION_TEXT = 'Eintrag wirklich löschen?';

    protected static array $dataTables;

    public $slug;
    public $livewireComponentName;
    
    /**
     * save place for the given laravels eloquent model
     *
     * @var mixed
     */
    protected $model;

    /**
     * set the headline to uppercase
     *
     * @var bool
     */
    protected bool $headerUppercase = false;
    protected bool $sortable = true;
    protected bool $pagination = false;
    protected bool $search = true;
    protected bool $wrapper = true;

    protected int $paginationLimit = 10;

    protected string|null $searchQuery = null;
    protected string|null $cssTableClass = null;
    protected string|null $linkRowsRoute = null;
    protected string|null $lastColumn = null;
    protected string|null $lastAction = null;
    protected string|null $lastContact = null;

    protected array $whereCoditions;
    protected array $columns;
    protected array $casts;
    protected array $datetimes;
    protected array $sortOnly;
    protected array $sortExpect;
    protected array $linkRowsParameters;
    protected array $withRelationships;
    protected array $counts;
    protected array $actions;
    protected array $confirmations;
    protected array $searchOnly;
    protected array $searchExpect;
    protected array $sorts;
    protected array $callbacks;
    protected array $accessColumns;
    protected array $accessActions;

    protected array $data;
    
    /**
     * boots the initial table collector
     *
     * @return void
     */
    public static function boot() {
        self::$dataTables = []; 
        self::registerLivewireComponent();
    }
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->whereCoditions = [];
        $this->columns = [];
        $this->sortExpect = [];
        $this->sortOnly = [];
        $this->linkRowsParameters = [];
        $this->datetimes = [];
        $this->withRelationships = [];
        $this->counts = [];
        $this->actions = [];
        $this->confirmations = [];
        $this->searchOnly = [];
        $this->searchExpect = [];
        $this->sorts = [];
        $this->callbacks = [];
        $this->accessActions = [];
        $this->accessColumns = [];
    }

    public function setData($data) {
        $this->data = $data;
        return $this;
    }
    
    /**
     * creates a new instance of DataTable
     *
     * @param  string $slug
     * @return DataTable
     */
    public static function create(string $slug) : DataTable {
        $dataTable = new DataTable();
        $dataTable->slug = $slug;
        self::$dataTables[] = $dataTable;
        return $dataTable;
    }
    
    /**
     * return a DataTable instance by the given slug
     *
     * @param string $table
     * @return DataTable
     */
    public static function getTable(string $table) : DataTable|null {
       foreach(self::$dataTables as $dataTable) {
            if($dataTable->slug == $table) {
                return $dataTable;
            }
       }
       return null;
    }
    
    /**
     * registers a new livewire component with a random name
     *
     * @return void
     */
    private static function registerLivewireComponent() {
        Livewire::component("inform-data-table::data-table",LivewireDataTable::class);
    }
    
    /**
     * binds a laravel eloqunt model the this DataTable instance
     *
     * @param  mixed $model
     * @return DataTable
     */
    public function setModelBinding($model) : DataTable {
        $this->model = $model;
        return $this;
    }
    
    /**
     * adds a whre condiation to the query
     *
     * @param  mixed $key
     * @param  mixed $operator
     * @param  mixed $search
     * @return DataTable
     */
    public function addWhereCondition($key,$operator = null,$search = null) : DataTable {
        if(!$operator) {
            $this->whereCoditions[] = [
                'key' => $key,
            ];
        }
        elseif(!$search) {
            $this->whereCoditions[] = [
                'key' => $key,
                'search' => $operator
            ];
        }
        else {
            $this->whereCoditions[] = [
                'key' => $key,
                'operator' => $operator,
                'search' => $search,
            ];
        }
        return $this;
    }

    public function setWhereConditions($whereCoditions) {
        $this->whereCoditions = $whereCoditions;
        return $this;
    }
    
    /**
     * enable the pagination of the data table
     *
     * @return DataTable
     */
    public function withPagination(int $limit = 15) : DataTable {
        $this->paginationLimit = $limit;
        $this->pagination = true;
        return $this;
    }
    
    /**
     * return that pagination in enabled or disabled
     *
     * @return bool
     */
    public function hasPagination() : bool {
        return $this->pagination;
    }
    
    /**
     * adds a column to the datatable
     *
     * @param  mixed $key
     * @param  mixed $name
     * @param  mixed $cast
     * @return DataTable
     */
    public function addColumn(string $key,string $name = null, string $cast = null) : DataTable {

        $name = ($name) ? $name : $key;
        $this->columns[] = ['key' => $key, 'name' => $name];
        $this->lastColumn = $key;
        $this->lastContact = 'column';
    

        if($cast) {
            $this->addCast($key,$cast);
        }
        return $this;
    }

    public function getLastAddedColumn() {
        if($this->lastColumn) {
            foreach($this->columns as $column) {
                if($column['key'] == $this->lastColumn) {
                    return $column;
                }
            }
        }
    }

    public function getLastAction() {
        if($this->lastAction) {
            foreach($this->actions as $action) {
                if($action['action_id'] == $this->lastAction) {
                    return $action;
                }
            }
        }
    }

    /**
     * adds a column to the datatable after the given key.
     * Important: key must be set befor!
     *
     * @param  string $key
     * @return DataTable
     */
    public function after(string $key) : DataTable {
        $lastArray = $this->getLastAddedColumn();
        $newArray = [];
        
        foreach($this->columns as $column) {
            if($column['key'] == $key) {
                $newArray[] = $column;
                $newArray[] = $lastArray;
            }
            else {
                if($column['key'] !=  $lastArray['key']) {
                    $newArray[] = $column;
                }
            }
        }
        $this->columns = $newArray;
        return $this;
    }
    
    /**
     * adds a cast to an column of the data table
     *
     * @param  mixed $key
     * @param  mixed $cast
     * @return void
     */
    public function addCast(string $key,string $cast) {
        $this->casts[$key] = ['key' => $key,'cast' => $cast];
        if($cast == 'datetime') {
            $this->setDateTimeFormat($key,self::DEFAULT_DATE_TIME_FORMAT);
        }
        return $this;
    }
    
    /**
     * set the datetime format for the given column (e.g. d.m.y H:i)
     *
     * @param  mixed $key
     * @param  mixed $format
     * @return DataTable
     */
    public function setDateTimeFormat(string $key,string $format) : DataTable {
        $this->datetimes[$key] = ['key' => $key,'format' => $format];
        return $this;
    }
    
    /**
     * checks the given column is in datetime format
     *
     * @param  mixed $key
     * @return bool
     */
    public function keyIsDatetime(string $key) : bool {
        if(array_key_exists($key,$this->datetimes)) {
            return true;
        }
        return false;
    }

    public function keyIsCount(string $key) : bool {
        if(in_array($key,$this->counts)) {
            return true;
        }
        return false;
    }

    public function css(string $css) : DataTable {
        $this->addToArray('css',$css);
        return $this;
    }
    
    /**
     * return the formated datetime string from Carbon instance
     *
     * @param  string $key
     * @param  Carbon\Carbon $value
     * @return string
     */
    public function getFormatedDateTime(string $key,Carbon $value) : string {
        return $value->format($this->datetimes[$key]['format']);
    }

    public function getCountContent(string $key,$value) : int {
        return $value->count();
    }
    
    /**
     * returns all regsitered columns
     *
     * @return array
     */
    public function getColumns() : array {
        return $this->columns;
    }

    
    /**
     * processes thrugh all registered where conditions
     *
     * @param  mixed $queryModel
     * @return void
     */
    public function processWhereConditions($queryModel) {
        foreach($this->whereCoditions as $condition) {
            if(!isset($condition['operator']) && !isset($condition['search'])) {
                if(array_key_exists($condition['key'],$this->data)){
                    $queryModel = $queryModel->where($condition['key'],$this->data[$condition['key']]);
                }
            }
            else {
                if(isset($condition['operator'])) {
                    $queryModel = $queryModel->where($condition['key'],$condition['operator'],$condition['search']);
                }
                else {
                    if(strpos($condition['key'],'->')) {
                        $queryModel = $queryModel->whereJsonContains($condition['key'],$condition['search']);
                    }
                    else {
                        $queryModel = $queryModel->where($condition['key'],$condition['search']);
                    }
                }
            }
        }
        return $queryModel;
    }

    public function getWhereConditions() {
        return $this->whereCoditions;
    }
    
    /**
     * return the registered css base class for the data table
     *
     * @return void
     */
    public function getCssTableClass() {
        return ($this->cssTableClass ? $this->cssTableClass : self::DEFAULT_CSS_TABLE_CLASS);
    }
    
    /**
     * return the query result for the data table as laravel eloqunt collection
     *
     * @return object
     */
    public function getResult() : object {
        $queryModel = new $this->model();
        $queryModel->withCasts(['updated_at' => 'datetime']);
        $queryModel = $this->processSearch($queryModel);
        $queryModel = $this->processWhereConditions($queryModel);
        $queryModel = $this->processWiths($queryModel);
        $queryModel = $this->processSort($queryModel);

        if($this->pagination) {
            return $queryModel->paginate($this->paginationLimit);
        }

        return $queryModel->get();
    }

    protected function processSearch(object $queryModel) : object {
        if($this->search && $this->searchQuery) {
            if(count($this->searchOnly)) {
                foreach($this->searchOnly as $search) {
                    $queryModel = $queryModel->where($search,'LIKE','%'.$this->searchQuery.'%');
                }
            }
            elseif(count($this->searchExpect)) {
                foreach($this->columns as $column) {
                    if(!in_array($column['key'],$this->searchExpect) && !in_array($column['key'],$this->withRelationships)) {
                        $queryModel = $queryModel->where($column['key'],'LIKE','%'.$this->searchQuery.'%');
                    }
                }
            }
            else {
                foreach($this->columns as $column) {
                    if(!in_array($column['key'],$this->withRelationships)) {
                        $queryModel = $queryModel->orWhere($column['key'],'LIKE','%'.$this->searchQuery.'%');
                    }
                }
            }
        }
        return $queryModel;
    }

    public function processWiths($queryModel) : object {
        foreach($this->withRelationships as $relationName) {
            $queryModel = $queryModel->with($relationName);
        }
        return $queryModel;
    }

    public function processSort(object $queryModel) : object {
        foreach($this->sorts as $sort) {
            $queryModel = $queryModel->orderBy($sort['key'],$sort['direction']);
        }
        return $queryModel;
    }
    
    /**
     * set the header to uppercase
     *
     * @return DataTable
     */
    public function headerUppercase() : DataTable {
        $this->headerUppercase = true;
        return $this;
    }
    
    /**
     * returns if the header uppercase option is enabled or disabled
     *
     * @return bool
     */
    public function isHeaderUpperCase() : bool {
        return $this->headerUppercase;
    }
    
    /**
     * return the registered model binding
     *
     * @return mixed
     */
    public function getModelBinding() {
        return $this->model;
    }
    
    /**
     * return if the given column is sortable
     *
     * @param  string $key
     * @return bool
     */
    public function isKeySortable(string $key) : bool {
        if(!$this->sortable) {
            return false;
        }
        if(in_array($key,$this->sortExpect)) {
            return false;
        }
        if(count($this->sortOnly) && !in_array($key,$this->sortOnly)) {
            return false;
        }
        return true;
    }
    
    /**
     * set the sortable option to disabled for all columns
     *
     * @return DataTable
     */
    public function unsortable() : DataTable{
        $this->sortable = false;
        return $this;
    }
    
    /**
     * set columns they are sortable only
     *
     * @param  array|string $sortOnlyArray
     * @return DataTable
     */
    public function sortOnly(array|string $sortOnlyArray) : DataTable {
        if(is_array($sortOnlyArray)) {
            $this->sortOnly = $sortOnlyArray;
        }
        else {
            $this->sortOnly = [$sortOnlyArray];
        }
        return $this;
    }
    
    /**
     * set column/s the will be expected for sorting
     *
     * @param  string|array $sortExpectArray
     * @return DataTable
     */
    public function sortExpect(string|array $sortExpectArray) : DataTable {
        if(is_array($sortExpectArray)) {
            $this->sortExpect = $sortExpectArray;
        }
        else {
            $this->sortExpect = [$sortExpectArray];
        }
        return $this;
    }
    
    /**
     * links the rows to the given route with route parameters
     *
     * @param  string $route
     * @param  array $params
     * @return DataTable
     */
    public function linkRows($route,...$params) : DataTable {
        $this->linkRowsRoute = $route;
        $this->linkRowsParameters = $params;
        return $this;
    }
    
    /**
     * return whether the row is linked
     *
     * @return bool
     */
    public function isRowLinked() : bool {
        return ($this->linkRowsRoute) ? true : false;
    }

    public function getRowLinkRoute() : string {
        return $this->linkRowsRoute;
    }

    public function getRowLinkParameters($rowObject) : array {
        $parameters = [];
        foreach($this->linkRowsParameters as $param) {
            $parameters[] = $rowObject->{$param};
        }
        return $parameters;
    }

    public function getActionParameters($rowObject,$action) : array {
        $parameters = [];
        foreach($action['parameters'] as $key => $value) {
            if(is_array($rowObject)) {
                $parameters[] = $rowObject[$value];
            }
            else {
                $parameters[] = $rowObject->{$value};
            }
        }
        return $parameters;
    }

    public function withPivot(string $relationName) : DataTable {
        $this->withRelationships[] = $relationName;
        return $this;
    }

    public function count() {
        $lastColumn = $this->getLastAddedColumn();
        $this->counts[] = $lastColumn['key'];
        return $this;
    }

    public function addAction(string $name, string $route,...$parameters) : DataTable {
        $actionId =  md5($name.$route);
        $this->actions[] = [
            'action_id' => $actionId,
            'name' => $name,
            'route' => $route,
            'parameters' => $parameters,
            'post' => false,
        ];
        $this->lastAction = $actionId;
        $this->lastContact = 'action';
        return $this;
    }

    public function getAction($action_id) : array {
        foreach($this->actions as $action) {
            if($action['action_id'] == $action_id) {
                return $action;
            }
        }
    }

    public function hasActions() {
        return (count($this->actions) ? true : false);
    }

    public function getActions() {
        return $this->actions;
    }

    public function icon(string $iconName) : DataTable{
        $this->addToArray('icon',$iconName);
        return $this;
    }

    public function confirmation($callbackFunction, string $confirmationText = null) : DataTable {
        $this->addToArray('confirmation',true);
        if(!$confirmationText) {
            $confirmationText = self::DEFAULT_CONFIRMATION_TEXT;
        }
        $action = $this->getLastAction();
        $this->confirmations[] = [
            'action_id' => $action['action_id'],
            'text' => $confirmationText,
            'callback' => $callbackFunction,
        ];

        return $this;
    }

    public function getConfirmation(string $action_id) : array {
        foreach($this->confirmations as $conf) {
            if($conf['action_id'] == $action_id) {
                return $conf;
            }
        }
    }

    public function callback($function) {
        $column = $this->getLastAddedColumn();
        $this->callbacks[$column['key']] = $function;
        return $this;
    }

    public function keyIsCallback($key) {
        if(array_key_exists($key,$this->callbacks)) {
            return true;
        }
        return false;
    }

    public function getCallback($key) {
        return $this->callbacks[$key];
    }

    protected function addToArray(string $key, string $value) : bool {
        switch($this->lastContact) {
            case "action":
                if(!$lastAction = $this->lastAction) {
                    return false;
                }
                for($i = 0; $i < count($this->actions); $i++) {
                    if($this->actions[$i]['action_id'] == $lastAction) {
                        $this->actions[$i][$key] = $value;
                    }
                }
                break;
            case "column":
                if(!$lastColumn = $this->lastColumn) {
                    return $this;
                }
                for($i = 0; $i < count($this->columns); $i++) {
                    if($this->columns[$i]['key'] == $lastColumn) {
                        $this->columns[$i][$key] = $value;
                    }
                }
                break;
            default:
                
            break;
        }
        return true;
    }

    public function disableSearch() {
        $this->search = false;
    }

    public function searchOnly(array|string $searchOnlyArray) : DataTable {
        if(is_array($searchOnlyArray)) {
            $this->searchOnly = $searchOnlyArray;
        }
        else {
            $this->searchOnly = [$searchOnlyArray];
        }
        return $this;
    }
    
    /**
     * set column/s the will be expected for sorting
     *
     * @param  string|array $sortExpectArray
     * @return DataTable
     */
    public function searchExpect(string|array $searchExpectArray) : DataTable {
        if(is_array($searchExpectArray)) {
            $this->searchExpect = $searchExpectArray;
        }
        else {
            $this->searchExpect = [$searchExpectArray];
        }
        return $this;
    }

    public function asPost() : DataTable {
        $lastAction = $this->getLastAction();
        $lastAction['post'] = true;
        $this->addToArray('post',true);

        return $this;
    }

    public function hasSearch() : bool {
        return $this->search;
    }

    public function searchFor(string|null $searchQuery) : DataTable {
        $this->searchQuery = $searchQuery;
        return $this;
    }

    public function setSort(string $key, string $direction) {
        $this->sorts[] = [
            'key' => $key,
            'direction' => $direction
        ];
    }

    public function access(string $area) : DataTable {
        if($this->lastContact == "action") {
            $lastAction = $this->getLastAction();
            $this->accessActions[$lastAction['name']] = $area;
        }
        elseif($this->lastContact == "column") {
            $lastColumn = $this->getLastAddedColumn();
            $this->accessColumns[$lastColumn['key']] = $area;
        }

        return $this;
    }

    public function columnHasAccess($key) {
        if(array_key_exists($key,$this->accessColumns)) {
            if(auth()->user()->hasAccess($this->accessColumns[$key])) {
                return true;
            }
            return false;
        }
        return true;
    }

    public function actionHasAccess($key) {
        if(array_key_exists($key,$this->accessActions)) {
            if(auth()->user()->hasAccess($this->accessActions[$key])) {
                return true;
            }
            return false;
        }
        return true;
    }

    public function withoutWrapper() : DataTable {
        $this->wrapper = false;
        return $this;
    }

    public function hasWrapper() : bool {
        return $this->wrapper;
    }
}