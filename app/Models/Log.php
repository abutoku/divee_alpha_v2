<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $dates =[
        'date'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    //userモデルのリレーション(userモデルに属する)
    //$log->user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //bookモデルのリレーション(bookモデルに属する)
    //$log->book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    //siteモデルのリレーション)
    //$log->site
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    //$log->divemap
    public function divemap()
    {
        return $this->hasOne(Divemap::class);
    }

}
