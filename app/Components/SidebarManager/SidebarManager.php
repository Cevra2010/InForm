<?php
namespace App\Components\SidebarManager;

class SidebarManager {
 
    private static $sidebarCollection;

    public static function boot() {
        self::$sidebarCollection = collect();
    }

    public static function register($route,$name,$icon,$access,$rating) {
        $sidebarObject = new SidebarObject();
        $sidebarObject->route = $route;
        $sidebarObject->name = $name;
        $sidebarObject->icon = $icon;
        $sidebarObject->access = $access;
        $sidebarObject->rating = $rating;
        self::$sidebarCollection->add($sidebarObject);
    }

    public function getObjects() {
        return self::$sidebarCollection->sortBy('rating');
    }

}