<?php
namespace App\Auth;

interface AuthInterface {

    public static function getName() : string;
    public static function getView() : string;

}
