<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
   protected $fillable = ['name', 'description'];

    // Một role có nhiều user
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
