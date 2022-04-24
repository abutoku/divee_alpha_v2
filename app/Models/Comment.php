<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    //postモデルのリレーションリレーション（postモデルに属する）
    // $comment->post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    //userモデルのリレーションリレーション（userモデルに属する）
    //$comment->user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
