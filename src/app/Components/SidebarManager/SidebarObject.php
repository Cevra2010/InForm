<?php 
namespace App\Components\SidebarManager;

use Gate;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\Facades\Route;
use Request;

class SidebarObject {
 
    public string $slug;
    public string|null $name = null;
    public string|null $route = null;
    public array $routeParameters = [];
    public string|null $icon = null;
    public string|null $access = null;
    public string|null $parent = null;
    public string|null $after = null;
    public $childs = null;
    public bool $headline = false;
    public array $gates = [];
    
    protected string|null $lastAddedsSlug = null;

    public function __construct(string $slug)
    {
        $this->slug = $slug;
        $this->childs = collect();
    }

    public function getUniqeId() {
        return 'sidebar_elemt_'.trim(strtolower(str_replace('-','_',$this->slug)));
    }

    public function setName(string $name) : SidebarObject {
        $this->name = $name;
        return $this;
    }

    public function setRoute($route,...$routeParameters) : SidebarObject {
        $this->route = $route;
        $this->routeParameters = $routeParameters;
        return $this;
    }

    public function getRoute() {
        if(!$this->route) {
            return "#";
        }
        if(count($this->routeParameters)) {
            return route($this->route,$this->routeParameters);
        }
        else {
            return route($this->route);
        }
    }

    public function isActive() {
        if($this->route == Request::route()->getName()) {
            return true;
        }
        return false;
    }

    public function setIcon(string $iconName) : SidebarObject {
        $this->icon = $iconName;
        return $this;
    }
    
    public function access(string $areaName) : SidebarObject {
        $this->access = $areaName;
        return $this;
    }

    public function setParent(string $parentSlug) {
        $this->parent = $parentSlug;
        return $this;
    }

    public function after($afterSlug) {
        $this->after = $afterSlug;
        return $this;
    }

    public function getChilds() {
        return $this->childs;
    }

    public function hasChilds() {
        return $this->childs->count();
    }

    public function headline() {
        $this->headline = true;
        return $this;
    }

    public function isHeadline() {
        return $this->headline;
    }

    public function setGate($ability,...$params) {
        $this->gates[] = [
            'ability' => $ability,
            'params' => $params,
        ];
    }

    public function hasAccess() {
        if($this->access) {
            return auth()->user()->hasAccess($this->access);
        }

        if(count($this->gates)) {
            foreach($this->gates as $gate){
                if(Gate::denies($gate['ability'],$gate['params'])) {
                    return false;
                }
            }
        }
        return true;
    }
}