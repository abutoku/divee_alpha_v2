<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // アプリケーション側でcreateなどできない値を記述する
    //$guardedはアプリケーション側から変更できないカラムを指定する（ブラックリスト）
    //$fillableはアプリケーション側から変更できるカラムを指定する（ホワイトリスト）．
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public static function getAllOrderByDate()
    {
        //selfは Postモデルのこと,orderBy()はSQLと同じ
        return self::orderBy('date', 'desc')->get();
    }

    //userモデルのリレーション(userモデルに属する)
    //$post->user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Userモデルのリレーション（多対多）
    //$post->users
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    //Commentモデルのリレーション（1対多）
    //$post->comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //Pictureモデルのリレーション（1対多）
    //$post->pictures
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }


}
