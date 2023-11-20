<?php
namespace App\Components\SidebarManager;

use Exception;

class SidebarObjectNotFoundException extends Exception {

    protected $message = 'Sidebar-Objekt konnte nicht gefunden werden.';

}