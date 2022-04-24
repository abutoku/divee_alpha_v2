<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];


    public static function getAllOrderByDiveCount()
    {
        //selfは Profileモデルのこと,orderBy()はSQLと同じ
        return self::orderBy('dive_count', 'desc')->get();
    }

    //Userモデルのリレーション（userモデルに属する）
    //$profile->user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //$profile->shop
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }


}
