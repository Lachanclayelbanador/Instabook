<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PhotoUser extends Pivot
{
    use HasFactory;
    protected static function booted()
    {
        /**
         * Permet de passer le test E, vérifier que l'utilisateur appartient au groupe dans lequel se trouve la photo pour commenter, c'est la relation
         * liée à celle du modele Comment.php
         */
        static::creating(function($photoUser){
            $photo = Photo::where('id', $photoUser->photo_id)->first();
            $group_user = GroupUser::where('user_id', $photoUser->user_id)
                ->where('group_id', $photo->group->id);
            if(!$group_user->exists()) return false;
            return true;
        });
    }
}
