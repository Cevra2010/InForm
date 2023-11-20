<?php

namespace App\Providers;

use App\Auth\DefaultLogin;
use App\AuthManager\AuthRegistry;
use App\Components\IconPicker\IconPicker;
use App\Components\SidebarManager\SidebarManager;
use App\Models\Group;
use App\Models\User;
use Cis\CisAccess\Models\Role;
use Components\InformDataTable\DataTable;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        AuthRegistry::register('login',DefaultLogin::class);
        IconPicker::boot();
        SidebarManager::boot();

        SidebarManager::register('dashboard')
        ->setName('Dashboard')
        ->setIcon('house');

        SidebarManager::register('account')
        ->setName('Mein Konto')
        ->setIcon("id-card")
        ->setRoute("backend.account.index");

        SidebarManager::register('user-headline')
        ->headline()
        ->setName('Konten & Zugriff');

        SidebarManager::register('users')
        ->setName('Konten')
        ->setIcon('user')
        ->access("user");

        SidebarManager::register('user-list')
        ->setName('Übersicht')
        ->setParent('users')
        ->setIcon('users')
        ->setRoute("backend.user.list")
        ->access("user.list");

        SidebarManager::register('user-add')
        ->setName('Konto erstellen')
        ->setParent('users')
        ->setIcon('user-plus')
        ->setRoute("backend.user.create-user")
        ->access("user.create");

        SidebarManager::register('roles')
        ->setName('Rollen')
        ->setIcon('scale-balanced')
        ->access("user.roles");

        SidebarManager::register('roles-overview')
        ->setName('Übersicht')
        ->setParent('roles')
        ->setRoute("backend.user.roles.list")
        ->access("user.roles");

        SidebarManager::register('role-add')
        ->setName('Neue Rolle erstellen')
        ->setParent('roles')
        ->setRoute("backend.user.roles.create")
        ->access("user.roles");

        SidebarManager::register('groups')
        ->setName('Gruppen')
        ->access("group")
        ->setIcon('people-group');

        SidebarManager::register('groups-index')
        ->setParent('groups')
        ->setIcon('people-roof')
        ->access("group")
        ->setName('Gruppenübersicht')
        ->setRoute('backend.group.index');

        SidebarManager::register('groups-add')
        ->setParent('groups')
        ->setIcon('plus')
        ->access("group.create")
        ->setName('Gruppe erstellen')
        ->setRoute('backend.group.create');

        SidebarManager::register('modules-headline')
        ->setName('Module')
        ->headline();

        SidebarManager::register('modules')
        ->setName('Installierte Module')
        ->setIcon('cubes')
        ->setRoute("backend.modules.list")
        ->access("modules");

        /*
        SidebarManager::register('backend.user.list','Benutzer','user-cog','user','1');  
        SidebarManager::register('backend.group.index','Benutzergruppen','user-group','group','2');   
        SidebarManager::register('backend.modules.list','Module','cubes','modules','3');   
        SidebarManager::register('kiosk::display.list','Bildschirme','display','display','4');
        */

        /**
         * Roles Table
         */
        DataTable::create('roles-table')
        ->addColumn('name','Rolle')
        ->addColumn('created_at','erstellt am','datetime')
        ->linkRows("backend.user.roles.show",'id')
        ->setModelBinding(Role::class);
        
        /**
         * Users Table
         */
        DataTable::create('users-table')
        ->addColumn('firstname','Vorname')
        ->addColumn('username','Benutzername')
        ->addColumn('updated_at','letzte änderung','datetime')
        ->addColumn('created_at','erstellt','datetime')
        ->addColumn('lastname','Nachname')->after('firstname')
        //->addColumn('test','TEST-AFTER')->after('lastname')
        ->addColumn('groups','Anzahl der Gruppen')->count()
        //->addAction('Bearbeiten','backend.user.show','id')->icon('user')->css('bg-teal-500 rounded text-white px-2 py-1 hover:bg-teal-600')
        ->addAction('Löschen','backend.user.show','id')->css('bg-red-500 rounded text-white px-2 py-1 hover:bg-red-600')->icon('trash')->confirmation(function($tableRow) {
            User::find($tableRow['id'])->delete();
        },'Benutzer wirklich löschen?')->access("user.edit.delete")
        ->linkRows('backend.user.show','id')
        ->withPivot('groups')
        ->sortOnly([
            'firstname',
            'lastname',
            'username',
        ])
        ->withPagination(4)
        ->setModelBinding(User::class);

        /**
         * UserGroups Table
         */
        DataTable::create("inform-user-groups")
        ->addColumn('name','Name')
        ->addColumn('badge','Badge')->callback(function($row) {
            return $row->getBadge();
        })
        ->addColumn('created_at','Erstellt','datetime')
        ->addColumn('updated_at','letzte Änderung','datetime')
        ->sortExpect('badge')
        ->searchExpect('badge')
        ->addAction('bearbeiten','backend.group.edit','id')
            ->css('bg-teal-700 rounded py-1 px-2 text-white')
            ->icon('edit')
            ->access("group.edit")
        ->addAction('löschen','backend.group.edit','id')
            ->css('bg-red-600 rounded py-1 px-2 text-white')
            ->icon('edit')
            ->access("group.delete")
            ->confirmation(function($group) {
                Group::find($group['id'])->delete();
            },'Möchten Sie die Gruppe wirklich löschen?')
        ->setModelBinding(Group::class);
    }
}
