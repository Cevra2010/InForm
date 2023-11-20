<?php
namespace App\AuthManager\Exceptions;

class AuthMethodNotFoundException extends \Exception {

    protected $message = 'The Auth Method was not found';

}
