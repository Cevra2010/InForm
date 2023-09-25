<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function showCreateGroupForm() {
        return view("backend.group.create");
    }

    public function showEditGroupForm(Group $group) {
        return view("backend.group.edit", [
            'group' => $group,
        ]);
    }


    public function updateGroup(StoreGroupRequest $request, Group $group) {
        $group->fill($request->all());
        $group->save();
        
        session()->flash('success','Änderungen wurden übernommen');
        return redirect()->route("backend.group.index");
    }

    public function storeNewGroup(StoreGroupRequest $request) {
        $group = new Group();
        $group->fill($request->all());
        $group->save();
        
        session()->flash('success','Änderungen wurden übernommen');
        return redirect()->route("backend.group.index");
    }

    public function showUserGroupsList() {
        $groups = Group::all();
        return view("backend.group.list",[
            'groups' => $groups,
        ]);
    }


}
