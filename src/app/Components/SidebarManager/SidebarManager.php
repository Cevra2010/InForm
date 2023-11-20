<?php
namespace App\Components\SidebarManager;

class SidebarManager {
 
    private static $sidebarObjects;
    private static $finalCollection;

    public static function boot() {
        self::$sidebarObjects = collect();
        self::$finalCollection = collect();
    }

    public static function register(string $slug) : SidebarObject {
        $sidebarObject = new SidebarObject($slug);
        self::$sidebarObjects->add($sidebarObject);
        return $sidebarObject;
    }

    public static function getSidebarObject($slug) {
        return self::$sidebarObjects->where('slug',$slug)->first();
    }

    protected function setParent($parentSlug,$childObject) {
        return $childObject;
    }

    public static function getSidebar() {
        foreach(self::$sidebarObjects->where('parent',null)->where('after',null) as $object) {
            self::$finalCollection = self::processParent();
        }

        return self::$finalCollection;


    }

    private static function processParent($parentObject = null,$collection = null) {


        if($parentObject == null) {
            $collection = collect();
            foreach(self::$sidebarObjects->where('parent',null)->where('after',null) as $object) {
                $collection->add($object);
                self::processParent($object,$collection);
            }
        }
        else {
            /** Process Afters */
            foreach(self::$sidebarObjects->where('after',$parentObject->slug) as $afterObject) {
                $collection->add($afterObject);
                self::processParent($afterObject,$afterObject->childs);
            }

            /** Process Childs */
            $childs = self::$sidebarObjects->where('parent',$parentObject->slug);
            $parentObject->childs = $childs;
            foreach($parentObject->childs as $childObject) {
                self::processParent($childObject,$parentObject->childs);
            }
        }

        return $collection;
    }



}