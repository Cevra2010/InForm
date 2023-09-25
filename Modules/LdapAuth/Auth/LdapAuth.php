<?php
namespace Modules\LdapAuth\Auth;

use App\Auth\AuthInterface;

class LdapAuth implements AuthInterface {

    public static function getName() : string {
        return "LDAP";
    }

    public static function getView(): string
    {
        return null;
    }

}
