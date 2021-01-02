<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected static function booted()
    {
        /**
         * Met en pause la création du model, vérifie que l'utilisateur est dans le groupe pour creer la photo dans ce meme groupe
         *
         * @param Illuminate\Database\Eloquent\Model;
         * @return boolean;
         */
        static::creating(function($photo){
            if(!GroupUser::where('user_id', $photo->owner->id)
                ->where('group_id', $photo->group->id)
                ->exists()) return false;
            return true;
        });
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function tags(){

        return $this->belongsToMany(Tag::class)->using(PhotoTag::class)->withPivot('id')->withTimestamps();

    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function group(){

        return $this->belongsTo(Group::class,'group_id','id');
    }

    public function users(){

        return $this->belongsToMany(User::class)->using(PhotoUser::class)->withPivot('id')->withTimestamps();
    }
}
