<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Cis\CisAccess\Models\Area;
use Cis\CisAccess\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();

        /**
         * CREATE USER/s
         */
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => Hash::make('password'),
            'firstname' => 'Admin',
            'lastname' => 'Istrator',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'username' => 'tester',
            'password' => Hash::make('test'),
            'firstname' => 'Test',
            'lastname' => 'Benutzer',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        /** CREATE ROLES */
        DB::table('roles')->insert([
            [
                'name' => 'Administrator',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Default',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        /** CREATE AREA/s */
        DB::table('areas')->insert([
            [
                'name' => 'Kontenverwaltung',
                'slug' => 'user',
                'parent_slug' => null,
            ],
            [
                'name' => 'Konten anzeigen',
                'slug' => 'user.list',
                'parent_slug' => 'user',
            ],
            [
                'name' => 'Konto erstellen',
                'slug' => 'user.create',
                'parent_slug' => 'user',
            ],
            [
                'name' => 'Konto anzeigen',
                'slug' => 'user.show',
                'parent_slug' => 'user',
            ],
            [
                'name' => 'Benutzerdaten bearbeiten',
                'slug' => 'user.edit.data',
                'parent_slug' => 'user.show',
            ],
            [
                'name' => 'Benutzerpasswort bearbeiten',
                'slug' => 'user.edit.password',
                'parent_slug' => 'user.show',
            ],
            [
                'name' => 'Benutzer löschen',
                'slug' => 'user.edit.delete',
                'parent_slug' => 'user.show',
            ],
            [
                'name' => 'Rollen eines Benutzers bearbeiten',
                'slug' => 'user.edit.roles',
                'parent_slug' => 'user.show',
            ],
            [
                'name' => 'Benutzerrollen bearbeiten',
                'slug' => 'user.roles',
                'parent_slug' => 'user',
            ],
            [
                'name' => 'Modulverwaltung',
                'slug' => 'modules',
                'parent_slug' => '',
            ],
            [
                'name' => 'Bildschirme verwalten',
                'slug' => 'display',
                'parent_slug' => null,
            ],
            [
                'name' => 'Bildschirm anlegen',
                'slug' => 'display.create',
                'parent_slug' => 'display',
            ],
            [
                'name' => 'Bildschirmliste anzeigen',
                'slug' => 'display.list',
                'parent_slug' => 'display',
            ],
            [
                'name' => 'Bildschirm bearbeiten',
                'slug' => 'display.edit',
                'parent_slug' => 'display',
            ],
            [
                'name' => 'Bildschirm löschen',
                'slug' => 'display.edit.delete',
                'parent_slug' => 'display.edit',
            ],
        ]);


        DB::table('areas')->insert([
            [
                'name' => 'Benutzergruppen',
                'slug' => 'group',
                'parent_slug' => null,
            ],
            [
                'name' => 'Benutzergruppe erstellen',
                'slug' => 'group.create',
                'parent_slug' => 'group',
            ],
            [
                'name' => 'Benutzergruppen bearbeiten',
                'slug' => 'group.edit',
                'parent_slug' => 'group',
            ],
            [
                'name' => 'Benutzergruppe löschen',
                'slug' => 'group.delete',
                'parent_slug' => 'group',
            ],
        ]
        );

        /** Displays */
        DB::table('displays')->insert([
            'name' => 'Display-1',
            'width' => null,
            'height' => null,
            'touch' => false,
            'controls' => false,
            'hash' => '6HPO-JGB9-KUZV-LKQ3',
            'last_action' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        /** SET USER WITH ID ALL PERMISSIONS */
        $role = Role::where('name','Administrator')->first();
        foreach(Area::all()  as $area) {
            $role->areas()->attach($area);
        }

        /** SET ADMIN USER TO ROLE */
        $user = User::find(1);
        $user->roles()->attach($role);
    }
}
