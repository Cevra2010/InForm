<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use Cis\CisAccess\Models\Area;
use Cis\CisAccess\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function list() {
        $roles = Role::all();
        return view('backend.user.roles.list',[
            'roles' => $roles,
        ]);
    }

    public function show(Role $role) {
        $areas = Area::where('parent_slug',null)->get();
        return view("backend.user.roles.show",[
            'areas' => $areas,
            'role' => $role,
        ]);
    }

    public function create() {
        return view("backend.user.roles.create");
    }

    public function store(StoreRoleRequest $request) {
        $role = new Role();
        $role->fill($request->all());
        $role->save();

        session()->flash("success",__('form.success'));
        return redirect()->route("backend.user.roles.show",$role);
    }
}
