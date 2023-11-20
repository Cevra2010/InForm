<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\ModuleManager\ModuleManager;
use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;

class ModuleController extends Controller
{
    public function list() {
        $modules = ModuleManager::getAllModules();
        return view("backend.modules.list",[
            'modules' => $modules,
        ]);
    }

    public function show($module) {
        $module = Module::find($module);
        return view("backend.modules.show",[
            'module' => $module
        ]);
    }
}
