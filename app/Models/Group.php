<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(){
        return $this->belongsToMany(User::class)->using(GroupUser::class)->withPivot('id')->withTimestamps();
    }

    public function photos(){
        return $this->hasMany(Photo::class,'id');
    }
}
