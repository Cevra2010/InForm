<?php
namespace App\Auth;

class DefaultLogin implements AuthInterface {
    public static function getName() : string
    {
        return "Default";
    }

    public static function getView() : string {
        return "auth.login";
    }
}
