<?php
namespace App\Components\ContentManager;

use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ReflectionClass;

class Content extends Model {

    use SoftDeletes;

    protected $table = 'contents';


    protected $casts = [
        'data' => AsArrayObject::class,
    ];

    protected $fillable = [
        'data',
        'created_at',
        'updated_at',
    ];

    protected static function booted(): void
    {
        static::creating(function (Content $content) {
            $content->attributes['source'] = $content->getSource(); auth()->user()->id;
            $content->attributes['created_by'] = auth()->user()->id;
        });
    }

    protected function getSource() {
        $reflect = new ReflectionClass($this);
        return $reflect->getShortName();
    }

    public function groups() {
        return $this->belongsToMany(Group::class);
    }

    public function createdBy() {
        return $this->hasOne(User::class,'id','created_by');
    }
    

}