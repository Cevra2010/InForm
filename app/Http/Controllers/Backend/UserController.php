<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserDataRequest;
use App\Http\Requests\StoreUserPasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list() {
        $users = User::all();
        return view("backend.user.list",[
            'users' => $users,
        ]);
    }

    public function show(User $user) {
        $deleteKey = strtoupper(auth()->user()->username."-".Carbon::now()->year."-".$user->username);
        return view("backend.user.show",[
            'user' => $user,
            'deleteKey' => $deleteKey,
        ]);
    }

    public function storeData(StoreUserDataRequest $request, User $user) {
        $user->fill($request->all());
        $user->save();

        session()->flash("success",__('form.success'));
        return redirect()->route("backend.user.show",$user);
    }

    public function storePassword(StoreUserPasswordRequest $request, User $user) {
        $user->password = Hash::make($request->get('password'));
        $user->save();

        session()->flash("success",__('form.success'));
        return redirect()->route("backend.user.show",$user);
    }

    public function createUser() {
        return view("backend.user.create");
    }

    public function storeUser(StoreUserRequest $request) {
        $user = new User();
        $user->fill($request->all());
        $user->save();

        session()->flash("success",__('form.success'));
        return redirect()->route("backend.user.show",$user);
    }

    public function deleteUser(Request $request, User $user) {
        $deleteKey = strtoupper(auth()->user()->username."-".Carbon::now()->year."-".$user->username);
        if($request->get('deleteKey') != $deleteKey){
            return redirect()->back()->withErrors(['key' => __('backend.user.wrong-safety-key')]);
        }

        $user->delete();
        session()->flash("success",__('form.success'));
        return redirect()->route("backend.user.list");
    }
}
