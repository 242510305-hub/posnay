<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];
    public function role()
    {
        return $this->hasMany(Role::class,'role_id');
    }
}
