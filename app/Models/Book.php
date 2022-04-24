<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    //userモデルのリレーションリレーション（userモデルに属する）
    //$book->user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //logモデルのリレーション（1対多）
    //$book->logs
    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    

}
