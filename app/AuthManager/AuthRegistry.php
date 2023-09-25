<?php
namespace App\AuthManager;

use App\AuthManager\Exceptions\AuthMethodNotFoundException;

class AuthRegistry {

    protected static array $authRegistryCollection;


    public static function init() : void {
        self::$authRegistryCollection = [];
    }

    public static function register(string $name,$class): void
    {
        self::$authRegistryCollection[] = [
            'name' => $name,
            'class' => $class,
        ];
    }

    public static function getAllAuthMethods() : array {
        $methods = [];
        foreach(self::$authRegistryCollection as $method) {
            $methods[] = new $method['class']();
        }
        return $methods;
    }

    public static function count() : int {
        return count(self::$authRegistryCollection) + 1;
    }

    public static function getView($authMethodName) {
        foreach(self::$authRegistryCollection as $item) {
            if($item['class']::getName() == $authMethodName) {
                return $item['class']::getView();
            }
        }

        throw new AuthMethodNotFoundException('The auth method "'.$authMethodName.'" wasn´t found in auth registry');
    }
}
