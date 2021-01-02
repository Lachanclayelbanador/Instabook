<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    protected static function booted()
    {
        /**
         * Met en pause la création du model, vérifie que l'utilisateur est dans le meme groupe que la photo pour commenter
         *
         * @param Illuminate\Database\Eloquent\Model;
         * @return boolean;
         */
        static::creating(function($comment){
            if(!GroupUser::where('user_id', $comment->user->id)
                ->where('group_id', $comment->photo->group->id)
                ->exists()) return false;
            return true;
        });
    }

    public function photo(){
        return $this->belongsTo(Photo::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Comment::class, 'comment_id');
    }

    public function replyTo(){
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }
}
