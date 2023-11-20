<?php
namespace App\Components\StepLog;

use App\Models\StepLog as ModelsStepLog;
use Illuminate\Database\Eloquent\Model;

class StepLog {
    
    public static function log($action,$changes) {

       if($changes instanceof Model) {
            dd($changes);
            $changes = $changes->changes;
       }

        if(is_array($changes)) {
            $changes = json_encode($changes);
        }

        ModelsStepLog::create([
            'action' => $action,
            'changes' => $changes,
            'user_id' => auth()->user()->id,
        ]);
    }

}